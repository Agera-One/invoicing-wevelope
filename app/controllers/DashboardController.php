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
        $invoice_value = $this->invoice->sumInvoiceValue();
        $total_revenue = $this->payment->sumRevenue();
        $invoices = $this->invoice->getAllCompact();
        $top_item = $this->item->getTopItem();
        $sum_unpaid_overdue = $this->invoice->sumUnpaidOverdue($today);

        $period = $this->payment->validatorPeriod('daily');
        $revenue_trend_raw = $this->payment->sumRevenuePeriod($period['periodKeyExpr'], $period['periodLabelExpr'], $this->companyId, $period['limit']);

        $period_invoice = $this->invoice->validatorPeriod('daily');
        $unpaid_trend_raw = $this->invoice->sumUnpaidPeriod($period_invoice['periodKeyExpr'], $period_invoice['periodLabelExpr'], $this->companyId, $period_invoice['limit']);

        $revenueByDate = [];
        foreach ($revenue_trend_raw as $r) {
            $revenueByDate[$r['period_key']] = $r['revenue'];
        }

        $unpaidByDate = [];
        foreach ($unpaid_trend_raw as $r) {
            $unpaidByDate[$r['period_key']] = $r['unpaid'];
        }

        $days = 7;
        $trend_labels = [];
        $trend_values = [];
        $unpaid_trend_values = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $d = date('Y-m-d', strtotime("-{$i} day"));
            $trend_labels[]        = date('d F Y', strtotime($d));
            $trend_values[]        = floatval($revenueByDate[$d] ?? 0);
            $unpaid_trend_values[] = floatval($unpaidByDate[$d] ?? 0);
        }

        $datas = [
            'number' => $number,
            'today' => $today,
            'invoice_value' => $invoice_value,
            'total_revenue' => $total_revenue,
            'invoices' => $invoices,
            'top_item' => $top_item,
            'total_unpaid'  => $sum_unpaid_overdue['total_unpaid']  ?? 0,
            'total_overdue' => $sum_unpaid_overdue['total_overdue'] ?? 0,
            'invoice_detail' => $this->invoiceDetail,
            'trend_labels' => $trend_labels,
            'trend_values' => $trend_values,
            'unpaid_trend_values' => $unpaid_trend_values,
        ];

        $this->view('dashboard/index', $datas);
    }
}