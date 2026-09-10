@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-6 mb-4">
            <h3 class="fw-bold h4 m-0 text-white">Edit Item</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item text-decoration-none"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item text-decoration-none"><a href="{{ route('item.index') }}">Items Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
            </ol>
        </div>
    </div>

    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Edit Item</div>
        </div>
        <form id="itemForm" action="{{ route('item.update', $item) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Reference Number</label>
                    <div class="d-flex align-items-center gap-2">
                        <div class="form-control-plaintext fs-5 fw-bold text-primary bg-body-secondary border rounded px-3 py-2 mb-0">
                            <i class="bi bi-upc-scan me-2"></i><span id="noFakturText">{{ $item->ref_no }}</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Name</label>
                    <input id="name" name="name" value="{{ $item->name }}" type="text" class="form-control">
                    <div class="invalid-feedback" id="nameError"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Price</label>
                    <input id="price" name="price" value="{{ $item->price }}" type="number" class="form-control">
                    <div class="invalid-feedback" id="priceError"></div>
                </div>
            </div>
            <div class="card-footer d-flex gap-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('item.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
