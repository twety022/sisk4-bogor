@extends('layouts.dashboard')
@section('title', 'Tambah Foto - SISK4 Admin')
@section('page-title', 'Tambah Foto Galeri')
@section('content')
<div class="dash-panel">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.gallery._form')
    </form>
</div>
@endsection