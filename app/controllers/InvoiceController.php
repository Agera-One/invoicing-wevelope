<?php

class InvoiceController extends BaseController
{
    private $invoice;
    private $invoiceDetail;
    private $customer;
    private $user;
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->invoice = $this->model('invoice');
        $this->invoiceDetail = $this->model('invoiceDetail');
        $this->customer = $this->model('customer');
        $this->user = $this->model('user');
        $this->db = $this->invoice->getConnection();
    }

    public function index()
    {
        $today = date('Y-m-d');
        $where_condition = [];
        $keyword = $_GET['keyword'] ?? '';
        $page = $_GET['page'] ?? 1;
        $date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
        $date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';

        $join_structure = [
            '[><]customer' => ['customer_id' => 'id'],
            '[>]invoice_detail' => ['id' => 'invoice_id'],
            '[>]payment' => ['id' => 'invoice_id'],
            '[><]user' => ['user_id' => 'id'],
        ];

        $where_condition['invoice.company_id'] = $this->companyId;

        if (!empty($date_from) && !empty($date_to)) {
            $where_condition['invoice.date[<>]'] = [$date_from, $date_to];
        } elseif (!empty($date_from)) {
            $where_condition['invoice.date[>=]'] = $date_from;
        } elseif (!empty($date_to)) {
            $where_condition['invoice.date[<=]'] = $date_to;
        }

        $where_condition = $this->search($keyword, $where_condition, ['invoice.invoice_code', 'customer.name', 'user.name']);
        $pagination = $this->invoice->pagination($this->db, $page, 'invoice', 'invoice.id', $where_condition, $join_structure);

        $invoices = $this->invoice->getAll($join_structure, $where_condition, $pagination['offset'], $pagination['limit']);

        $datas = [
            'today' => $today,
            'keyword' => $keyword,
            'page' => $page,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'pagination' => $pagination,
            'invoices' => $invoices,
            'invoice_detail' => $this->invoiceDetail,
        ];

        $this->view('invoice/index', $datas);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['company_id'] = $this->companyId;
            $_POST['user_id'] = $this->userId;
            unset($_POST['invoice_code']);

            $_POST['invoice_code'] = $this->invoice->generateCode($this->db, "invoice", "invoice_code", "INV");

            $this->invoice->create($_POST);
            $invoice_id = $this->db->id();
            $this->redirect(BASEURL . 'invoice/detail/' . $invoice_id);
            return;
        }

        $invoice_code = $this->invoice->generateCode($this->db, "invoice", "invoice_code", "INV");
        $user_id = $_POST['user_id'] ?? '';
        $customer_id = $_POST['customer_id'] ?? '';

        $customer_data = $this->customer->getAll(['company_id' => $this->companyId]);

        $datas = [
            'invoice_code' => $invoice_code,
            'user_id' => $user_id,
            'customer_id' => $customer_id,
            'customer_data' => $customer_data,
        ];

        $this->view('invoice/add', $datas);
    }

    public function edit($id)
    {
        $invoices = $this->invoice->find($id);
        $customer_data = $this->customer->getAll(['company_id' => $this->companyId]);

        $datas = [
            'invoices' => $invoices,
            'customer_data' => $customer_data,
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->invoice->update($id, $_POST);
            $this->redirect(BASEURL . 'invoice');
        } else {
            $this->view('invoice/edit', $datas);
        }
    }

    public function delete($id)
    {
        $total_invoice_detail = $this->db->has('invoice_detail', [
            'invoice_id' => $id
        ]);

        $total_payment = $this->db->has('payment', [
            'invoice_id' => $id
        ]);

        if ($total_invoice_detail || $total_payment) {
            echo
            '<script>
                alert("The invoice cannot be deleted because it is still being used by another table.");
                window.location.href = "' . BASEURL . 'invoice";
            </script>';

            exit;
        } else {
            $this->invoice->delete($id);
            $this->redirect(BASEURL . 'invoice');
        }
    }
}
