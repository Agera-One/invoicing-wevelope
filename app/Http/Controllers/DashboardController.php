<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $number = 1;
        $today = date('Y-m-d');
        $invoice_value = Invoice::where('company_id', $this->companyId)
            ->withSum('details', 'amount')
            ->get()
            ->sum('details_sum_amount') ?: 0;
        $total_revenue = $this->payment->sumRevenue();
        $invoices = $this->invoice->getAllCompact();
        $top_item = $this->item->getTopItem();
        $sum_unpaid_overdue = $this->invoice->sumUnpaidOverdue($today);

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
        ];

        return view('pages.dashboard.index', compact(
            'number',
            'today',
            'invoice_value',
            'total_revenue',
            'invoices',
            'top_item',
            'total_unpaid',
            'total_overdue',
            'invoice_detail'
        ));
    }
}
