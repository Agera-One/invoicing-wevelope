<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        $number = 1;
        $today = date('Y-m-d');
        $total_revenue = Payment::sum('amount');
        $total_overdue = 400000;
        $total_customer = Customer::count();
        $total_invoice = Invoice::count();
        $invoices = [];
        $top_item = [];

        return view('pages.dashboard.index', compact(
            'number',
            'today',
            'total_revenue',
            'total_overdue',
            'total_customer',
            'total_invoice',
            'invoices',
            'top_item',
        ));
    }
}
