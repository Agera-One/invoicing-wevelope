<?php

class DashboardController extends BaseController
{
    private $invoice;
    private $payment;
    private $item;
    private $invoiceDetail;
    private $customer;

    public function __construct()
    {
        parent::__construct();
        $this->invoice = $this->model('invoice');
        $this->payment = $this->model('payment');
        $this->item = $this->model('item');
        $this->invoiceDetail = $this->model('invoiceDetail');
        $this->customer = $this->model('customer');
    }

    public function index()
    {
        $number = 1;
        $today = date('Y-m-d');
        $total_invoice = $this->invoice->countTotalInvoice();
        $total_customer = $this->customer->countTotalCustomer();
        $total_revenue = $this->payment->sumRevenue();
        $invoices = $this->invoice->getAllCompact();
        $top_item = $this->item->getTopItem();
        $sum_overdue = $this->invoice->sumOverdue($today);

        $datas = [
            'number' => $number,
            'today' => $today,
            'total_invoice' => $total_invoice,
            'total_customer' => $total_customer,
            'total_revenue' => $total_revenue,
            'invoices' => $invoices,
            'top_item' => $top_item,
            'total_overdue' => $sum_overdue['total_overdue'] ?? 0,
            'invoice_detail' => $this->invoiceDetail,
        ];

        $this->view('dashboard/index', $datas);
    }
}
