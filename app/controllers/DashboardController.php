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
        $total_overdue = $sum_overdue['total_overdue'] ?? 0;

        $invoice_value = $this->invoice->sumInvoiceValue();
        $sum_unpaid = $this->invoice->sumUnpaid($today);
        $total_unpaid = $sum_unpaid['total_unpaid'] ?? 0;

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

        $trend_latest = $trend_values ? end($trend_values) : 0;
        $trend_prev = count($trend_values) > 1 ? $trend_values[count($trend_values) - 2] : 0;

        $unpaid_trend_latest = $unpaid_trend_values ? end($unpaid_trend_values) : 0;
        $unpaid_trend_prev = count($unpaid_trend_values) > 1 ? $unpaid_trend_values[count($unpaid_trend_values) - 2] : 0;

        $mini_stats = [
            ['label' => 'Invoice Value', 'value' => 'Rp' . number_format($invoice_value, 0, ',', '.'), 'text' => 'text-white', 'icon' => 'bi-receipt-cutoff text-custom'],
            ['label' => 'Total Revenue', 'value' => 'Rp' . number_format($total_revenue, 0, ',', '.'), 'text' => 'text-white', 'icon' => 'bi-cash-coin text-custom-success'],
            ['label' => 'Total Outstanding', 'value' => 'Rp' . number_format($total_unpaid, 0, ',', '.'), 'text' => 'text-white', 'icon' => 'bi-hourglass-split text-custom-warning'],
            ['label' => 'Total Overdue', 'value' => 'Rp' . number_format($total_overdue, 0, ',', '.'), 'text' => 'text-danger', 'icon' => 'bi-exclamation-triangle text-custom-danger'],
        ];

        $oo_breakdown = [
            ['label' => 'Outstanding', 'value' => $total_unpaid, 'color' => '#dbd847'],
            ['label' => 'Overdue', 'value' => $total_overdue, 'color' => '#dc3545'],
        ];

        $datas = [
            'number' => $number,
            'today' => $today,
            'total_invoice' => $total_invoice,
            'total_customer' => $total_customer,
            'total_revenue' => $total_revenue,
            'invoices' => $invoices,
            'top_item' => $top_item,
            'total_overdue' => $total_overdue,
            'total_unpaid' => $total_unpaid,
            'invoice_value' => $invoice_value,
            'invoice_detail' => $this->invoiceDetail,
            'trend_labels' => $trend_labels,
            'trend_values' => $trend_values,
            'unpaid_trend_values' => $unpaid_trend_values,
            'trend_latest' => $trend_latest,
            'trend_prev' => $trend_prev,
            'unpaid_trend_latest' => $unpaid_trend_latest,
            'unpaid_trend_prev' => $unpaid_trend_prev,
            'mini_stats' => $mini_stats,
            'oo_breakdown' => $oo_breakdown,
        ];

        $this->view('dashboard/index', $datas);
    }
}
