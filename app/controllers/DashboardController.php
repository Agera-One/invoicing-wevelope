<?php

class DashboardController extends BaseController
{
    private $invoice;
    private $payment;
    private $item;
    private $invoiceDetail;

    public function __construct()
    {
        parent::__construct();
        $this->invoice = $this->model('invoice');
        $this->payment = $this->model('payment');
        $this->item = $this->model('item');
        $this->invoiceDetail = $this->model('invoicedetail');
    }

    public function index()
    {
        $number = 1;
        $today = date('Y-m-d');
        $total_invoice = $this->invoice->countTotalInvoice();
        $total_revenue = $this->payment->sumRevenue();
        $invoices = $this->invoice->getAllCompact();
        $top_item = $this->item->getTopItem();
        $sum_unpaid_overdue = $this->invoice->sumUnpaidOverdue($today);

        $datas = [
            'number' => $number,
            'today' => $today,
            'total_invoice' => $total_invoice,
            'total_revenue' => $total_revenue,
            'invoices' => $invoices,
            'top_item' => $top_item,
            'total_outstanding'  => $sum_unpaid_overdue['total_outstanding']  ?? 0,
            'total_overdue' => $sum_unpaid_overdue['total_overdue'] ?? 0,
            'invoice_detail' => $this->invoiceDetail,
        ];

        $this->view('dashboard/index', $datas);
    }
}
