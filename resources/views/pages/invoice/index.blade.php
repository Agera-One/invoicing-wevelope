@extends('layouts.app')

@section('title', 'Invoices Billing')

@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-sm-6 mb-4">
                <h3 class="fw-bold h4 m-0 text-white">Invoices Billing</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item text-decoration-none"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Invoices Billing</li>
                </ol>
            </div>
        </div>

        <div class="flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('invoice.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add New Invoice
                </a>
            </div>

            <form method="GET">
                <div class="row g-3 my-3">
                    <div class="col-md-4">
                        <label class="form-label">Keyword</label>
                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Search for customers and invoice codes..."
                            value="<?= $keyword ?? '' ?>"
                            disabled>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date From</label>
                        <input
                            type="date"
                            name="date_from"
                            class="form-control"
                            value="<?= $date_from ?? ''; ?>"
                            disabled>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date To</label>
                        <input
                            type="date"
                            name="date_to"
                            class="form-control"
                            value="<?= $date_to ?? ''; ?>"
                            disabled>
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-3">
                        <button id="btn-search" type="submit" class="btn btn-md btn-primary w-100" name="search">
                            <i class="bi bi-search me-1"></i>Search
                        </button>
                        <a href="{{ route('invoice.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7 tracking-wider">
                            <tr>
                                <th class="ps-4 fs-5" width="60">#</th>
                                <th class="fs-6">Invoice Code</th>
                                <th class="fs-6">Customer Name</th>
                                <th class="fs-6">Invoice Date</th>
                                <th class="fs-6">Due Date</th>
                                <th class="fs-6">Total Bill</th>
                                <th class="fs-6 text-center">Status</th>
                                <th class="fs-6 pe-4" width="200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                            @php
                                $remaining_unpaid = $invoice->invoice_details_sum_amount - $invoice->payments_sum_amount;
                            @endphp
                                <tr>
                                    <th class="fs-6 ps-4 text-muted fw-normal">{{ $invoices->firstItem() + $loop->index }}</th>
                                    <td class="fs-6">{{ $invoice->invoice_code }}</td>
                                    <td class="fs-6">{{ $invoice->customer->name }}</td>
                                    <td class="fs-6">{{ $invoice->date }}</td>
                                    <td class="fs-6">{{ $invoice->due_date }}</td>
                                    <td class="fs-6">Rp{{ number_format($invoice->invoice_details_sum_amount, 0, ',', '.') }}</td>
                                    @if ($invoice->invoice_details_count == 0)
                                        <td class="fs-6 text-center"><span class="badge text-bg-secondary">No Item</span></td>
                                    @elseif ($remaining_unpaid > 0 && $invoice->due_date < $today)
                                        <td class="fs-6 text-center"><span class="badge text-bg-danger">Overdue</span></td>
                                    @elseif ($remaining_unpaid > 0)
                                        <td class="fs-6 text-center"><span class="badge text-bg-warning">Unpaid</span></td>
                                    @elseif ($remaining_unpaid < 0)
                                        <td class="fs-6 text-center"><span class="badge text-bg-info">Overpaid</span></td>
                                    @else
                                        <td class="fs-6 text-center"><span class="badge text-bg-success">Paid</span></td>
                                    @endif
                                    <td class="pe-4">
                                        <div class="d-flex gap-3">
                                            {{-- <a class="btn btn-sm btn-info text-black" href="<?= BASEURL . 'invoice/detail' ?>/<?= $invoice['id'] ?>">Detail</a> --}}
                                            {{-- <a class="btn btn-sm btn-success" href="{{ route('invoice.edit', $invoice) }}">Edit</a>
                                            <form action="{{ route('invoice.destroy', $invoice) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this invoice?');">Delete</button>
                                            </form> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="border-top align px-4">
                {{ $invoices->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
