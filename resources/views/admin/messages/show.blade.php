@extends('layouts.dashboard')

@section('title', 'Detail Pesan - SISK4 Admin')
@section('page-title', 'Detail Pesan')

@section('content')

<a href="{{ route('admin.messages.index') }}" class="dash-back-link"><i class="bi bi-arrow-left"></i> Kembali ke Pesan Masuk</a>

<div class="dash-panel mt-3">
    <div class="dash-message-meta">
        <div>
            <h5 class="mb-1">{{ $message->subject }}</h5>
            <p class="text-muted small mb-0">
                Dari <strong>{{ $message->name }}</strong> ({{ $message->email }})
                @if ($message->phone) &middot; {{ $message->phone }} @endif
            </p>
        </div>
        <span class="text-muted small">{{ $message->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
    </div>

    <hr>

    <p class="dash-message-body">{{ $message->message }}</p>

    <div class="dash-form-actions">
        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="dash-btn-primary">
            <i class="bi bi-reply-fill"></i> Balas via Email
        </a>
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Yakin mau hapus pesan ini?');">
            @csrf @method('DELETE')
            <button type="submit" class="dash-btn-secondary dash-btn-danger-outline">
                <i class="bi bi-trash"></i> Hapus Pesan
            </button>
        </form>
    </div>
</div>

@endsection