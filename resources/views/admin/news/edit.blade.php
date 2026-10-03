@extends('layouts.dashboard')

@section('title', 'Edit Berita - SISK4 Admin')
@section('page-title', 'Edit Berita')

@section('content')
<div class="dash-panel">
    <form action="{{ route('admin.news.update', $article) }}" method="POST" enctype="multipart/form-data">
        @include('admin.news._form')
    </form>
</div>
@endsection