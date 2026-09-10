@extends('layouts.app')

@section('title', 'Customers Management')

@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-sm-6 mb-4">
                <h3 class="fw-bold h4 m-0 text-white">Customers Management</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item text-decoration-none"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Customers Management</li>
                </ol>
            </div>
        </div>

        <div class="d-flex flex-wrap align-item-center justify-content-between gap-3 mb-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="/customer/create" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add New Customer
                </a>
                <a href="/customer/export" class="btn btn-outline-secondary">
                    <i class="bi bi-filetype-csv me-1"></i>
                    Export CSV
                </a>
                <a href="/customer/import" class="btn btn-outline-secondary">
                    <i class="bi bi-filetype-csv me-1"></i>
                    Import CSV
                </a>
            </div>

            <div class="col-md-4 d-flex align-items-end gap-2">
                <form method="GET" class="flex-grow-1">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input name="search" id="table-filter" type="text" class="form-control border-start-0 ps-0" placeholder="Filter rows…" aria-label="Filter rows" autofocus autocomplete="off" value="{{ request('search') }}" disabled>
                    </div>
                </form>
                <a href="/customer" class="btn btn-outline-secondary w-25">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7 tracking-wider">
                            <tr>
                                <th class="fs-5 ps-4" width="60">#</th>
                                <th class="fs-6">Customer Code</th>
                                <th class="fs-6">Name</th>
                                <th class="fs-6">Email</th>
                                <th class="fs-6">Phone</th>
                                <th class="fs-6">Address</th>
                                <th class="fs-6 pe-4" width="160">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="fs-6">{{ $customers->firstItem() + $loop->index }}</td>
                                    <td class="fs-6">{{ $customer->customer_code }}</td>
                                    <td class="fs-6">{{ $customer->name }}</td>
                                    <td class="fs-6">{{ $customer->email }}</td>
                                    <td class="fs-6">{{ $customer->phone }}</td>
                                    <td class="fs-6">{{ $customer->address }}</td>
                                    <td class="pe-4">
                                        <div class="d-flex gap-1">
                                            <a class="btn btn-sm btn-success" href="{{ route('customer.edit', $customer) }}">Edit</a>
                                            <form action="{{ route('customer.destroy', $customer) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="border-top align px-4">
                {{ $customers->onEachSide(0)->links() }}
            </div>
        </div>

    </div>
@endsection
