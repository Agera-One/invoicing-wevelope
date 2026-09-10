@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-6 mb-4">
            <h3 class="fw-bold h4 m-0 text-white">Add Customer</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item text-decoration-none"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item text-decoration-none"><a href="{{ route('customer.index') }}"">Customers Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Customer</li>
            </ol>
        </div>
    </div>

    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Add New Customer</div>
        </div>
        <form id="customerForm" action="{{ route('customer.store') }}" method="POST">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Customer Code</label>
                    <div class="d-flex align-items-center gap-2">
                        <div class="form-control-plaintext fs-5 fw-bold text-primary bg-body-secondary border rounded px-3 py-2 mb-0">
                            <i class="bi bi-upc-scan me-2"></i><span>{{ $code }}</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input value="{{ old('name') }}" id="name" name="name" type="text" class="form-control" required>
                    <div class="invalid-feedback" id="nameError"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input value="{{ old('email') }}" id="email" name="email" type="email" class="form-control" required>
                    <div class="invalid-feedback" id="emailError"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input value="{{ old('phone') }}" id="phone" name="phone" type="tel" class="form-control" required>
                    <div class="invalid-feedback" id="phoneError"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input value="{{ old('address') }}" id="address" name="address" type="text" class="form-control" required>
                    <div class="invalid-feedback" id="addressError"></div>
                </div>
            </div>
            <div class="card-footer d-flex gap-3">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('customer.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
