@extends('layouts.dashboard')
@section('title', 'Edit Foto - SISK4 Admin')
@section('page-title', 'Edit Foto Galeri')
@section('content')
<div class="dash-panel">
    <form action="{{ route('admin.gallery.update', $photo) }}" method="POST" enctype="multipart/form-data">
        @include('admin.gallery._form')
    </form>
</div>
@endsection