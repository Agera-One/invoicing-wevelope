@extends('layouts.app')

@section('title', 'Item Management')

@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-sm-6 mb-4">
                <h3 class="fw-bold h4 m-0 text-white">Items Management</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item text-decoration-none"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Items Management</li>
                </ol>
            </div>
        </div>

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="/item/create" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add New Item
                </a>
            </div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <form method="GET" class="flex-grow-1">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input name="search" id="table-filter" type="text" class="form-control border-start-0 ps-0" placeholder="Filter rows…" aria-label="Filter rows" autofocus autocomplete="off" value="{{ request('search') }}">
                    </div>
                </form>
                <a href="/item" class="btn btn-outline-secondary w-25">
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
                                <th class="ps-4 fs-5" width="60">#</th>
                                <th class="fs-6">Reference Number</th>
                                <th class="fs-6">Name</th>
                                <th class="fs-6">Price</th>
                                <th class="fs-6" class="pe-4" width="160">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="fs-6">{{ $items->firstItem() + $loop->index }}</td>
                                    <td class="fs-6">{{ $item->ref_no }}</td>
                                    <td class="fs-6">{{ $item->name }}</td>
                                    <td class="fs-6">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="pe-4">
                                        <div class="d-flex gap-1">
                                            <a class="btn btn-sm btn-success px-3" href="/item/edit/{{ $item->id }}">Edit</a>
                                            <a class="btn btn-sm btn-danger px-2" href="/item/delete/{{ $item->id }}"
                                                onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $items->links() }}
        </div>
    </div>
@endsection
