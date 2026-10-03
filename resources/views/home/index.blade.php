@extends('layouts.app')

@section('title', 'Beranda - SISK4 Bogor')
@section('meta_description', 'Selamat datang di Website SISK4 Bogor, portal informasi resmi SMKN 4 Bogor.')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="home-v3">
    @include('partials.home.hero')
    @include('partials.home.about')
    @include('partials.home.features')
    @include('partials.home.stats')
    @include('partials.home.news')
    @include('partials.home.gallery')
    @include('partials.home.location')
</div>
@endsection