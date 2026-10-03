@extends('layouts.dashboard')

@section('title', 'Tambah Produk - SISK4 Admin')
@section('page-title', 'Tambah Produk')

@section('content')

<a href="{{ route('admin.products.index') }}" class="dash-back-link mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<div class="dash-panel">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.products._form')
    </form>
</div>

@endsection