@extends('layouts.app')

@section('title', 'Item Management')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-6 mb-4">
            <h3 class="fw-bold h4 m-0 text-white">Add Item</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item text-decoration-none"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item text-decoration-none"><a href="/item">Items Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Item</li>
            </ol>
        </div>
    </div>

    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Add New Item</div>
        </div>
        <form id="itemForm" action="/item" method="POST">
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Reference Number</label>
                    <div class="d-flex align-items-center gap-2">
                        <div class="form-control-plaintext fs-5 fw-bold text-primary bg-body-secondary border rounded px-3 py-2 mb-0">
                            <i class="bi bi-upc-scan me-2"></i><span>REF-2026-001</span>
                        </div>
                        {{-- <input type="hidden" name="ref_no" value="<?= $ref_no ?>"> --}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Name</label>
                    <input id="name" name="name" type="text" class="form-control" required>
                    <div class="invalid-feedback" id="nameError"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Price</label>
                    <input id="price" name="price" type="number" class="form-control" required>
                    <div class="invalid-feedback" id="priceError"></div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="/item" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
