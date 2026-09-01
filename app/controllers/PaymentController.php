<?php

class PaymentController extends BaseController
{
    private $payment;
    private $invoice;
    private $invoiceDetail;
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->payment = $this->model('payment');
        $this->invoice = $this->model('invoice');
        $this->invoiceDetail = $this->model('invoicedetail');
        $this->db = $this->invoice->getConnection();
    }

    public function index()
    {
        $search = $_GET['search'] ?? '';
        $page = $_GET['page'] ?? 1;

        $where_condition['invoice.company_id'] = $this->companyId;

        $join_structure = [
            '[><]invoice' => ['invoice_id' => 'id'],
            '[>]customer' => ['invoice.customer_id' => 'id']
        ];

        $where_condition = $this->search($search, $where_condition, ['payment.payment_code', 'invoice.invoice_code', 'customer.name', 'payment.date']);
        $pagination = $this->payment->pagination($this->db, $page, 'payment', 'payment.id', $where_condition, $join_structure);

        $payments = $this->payment->getAll($join_structure, $where_condition, $pagination['offset'], $pagination['limit']);

        $datas = [
            'search' => $search,
            'page' => $page,
            'pagination' => $pagination,
            'payments' => $payments,
        ];

        $this->view('payment/index', $datas);
    }

    public function add($get_invoice_id = '')
    {
        $payment_code = $this->payment->generateCode($this->db, "payment", "payment_code", "PAY");

        $invoice_id  = $_POST['invoice_id'] ?? $get_invoice_id;

        $join_structure = [
            '[><]customer' => ['customer_id' => 'id'],
            '[>]invoice_detail' => ['id' => 'invoice_id'],
            '[>]payment' => ['id' => 'invoice_id'],
            '[><]user' => ['user_id' => 'id'],
        ];

        $where_condition = ['invoice.company_id' => $this->companyId];

        $invoice_data = $this->invoice->getAll($join_structure, $where_condition);

        $selected_invoice = null;
        foreach ($invoice_data as $invoice) {
            if ((string)$invoice['id'] === (string)$invoice_id) {
                $selected_invoice = $invoice;
                break;
            }
        }

        $datas = [
            'payment_code' => $payment_code,
            'invoice_id' => $invoice_id,
            'invoice_data' => $invoice_data,
            'selected_invoice' => $selected_invoice,
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['invoice_id'] = $invoice_id;

            $this->payment->create($_POST);
            $this->redirect(BASEURL . 'payment');
        } else {
            $this->view('payment/add', $datas);
        }
    }

    public function edit($id)
    {
        $payment_data = $this->payment->find($id);

        $join_structure = [
            '[><]customer' => ['customer_id' => 'id'],
            '[>]invoice_detail' => ['id' => 'invoice_id'],
            '[>]payment' => ['id' => 'invoice_id'],
            '[><]user' => ['user_id' => 'id'],
        ];

        $where_condition = ['invoice.company_id' => $this->companyId];

        $invoice_data = $this->invoice->getAll($join_structure, $where_condition);

        $selected_invoice = null;
        foreach ($invoice_data as $invoice) {
            if ((string)$invoice['id'] === (string)$payment_data['invoice_id']) {
                $selected_invoice = $invoice;
                break;
            }
        }

        if ($selected_invoice) {
            $selected_invoice['total_amount_paid'] -= $payment_data['amount'];

            foreach ($invoice_data as &$invoice) {
                if ((string)$invoice['id'] === (string)$payment_data['invoice_id']) {
                    $invoice['total_amount_paid'] -= $payment_data['amount'];
                    break;
                }
            }
            unset($invoice);
        }

        $datas = [
            'payment_data' => $payment_data,
            'invoice_data' => $invoice_data,
            'selected_invoice' => $selected_invoice,
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$selected_invoice) {
                $datas['error'] = 'Invoice not found.';
                $this->view('payment/edit', $datas);
                return;
            }

            $amount = (float) ($_POST['amount'] ?? 0);
            $remaining = $selected_invoice['total_bill'] - $selected_invoice['total_amount_paid'];

            if ($amount <= 0 || $amount > $remaining) {
                $datas['error'] = 'Payment amount (Rp' . number_format($amount, 0, ',', '.')
                    . ') exceeds the remaining balance (Rp' . number_format(max($remaining, 0), 0, ',', '.') . ').';
                $this->view('payment/edit', $datas);
                return;
            }

            $allowed = ['invoice_id', 'date', 'amount'];
            $update_data = array_intersect_key($_POST, array_flip($allowed));

            $this->payment->update($id, $update_data);
            $this->redirect(BASEURL . 'payment');
        } else {
            $this->view('payment/edit', $datas);
        }
    }

    public function delete($id)
    {
        $this->payment->delete($id);
        $this->redirect(BASEURL . 'payment');
    }
}
