<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');

        $invoices = Invoice::with('customer')
            ->withCount('invoiceDetails')
            ->withSum('invoiceDetails', 'amount')
            ->withSum('payments', 'amount')
            ->latest('id')
            ->paginate(10);

        return view('pages.invoice.index', compact('invoices', 'today'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Invoice $invoice)
    {
        //
    }

    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    public function destroy(Invoice $invoice)
    {
        //
    }
}
