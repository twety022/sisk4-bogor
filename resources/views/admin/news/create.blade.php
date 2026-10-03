@extends('layouts.dashboard')

@section('title', 'Tambah Berita - SISK4 Admin')
@section('page-title', 'Tambah Berita Baru')

@section('content')
<div class="dash-panel">
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.news._form')
    </form>
</div>
@endsection