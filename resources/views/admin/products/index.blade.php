@extends('layouts.dashboard')

@section('title', 'Kelola Produk - SISK4 Admin')
@section('page-title', 'Produk Siswa')

@section('content')

@php
   $statusColor = ['tersedia' => '#34d399', 'pesanan' => '#fbbf24', 'portofolio' => '#7c9dff'];
@endphp

<div class="dash-toolbar">
    <p class="text-muted small mb-0">Total {{ $products->total() }} produk</p>
    <a href="{{ route('admin.products.create') }}" class="dash-btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

<div class="dash-table-wrap">
    <table class="dash-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jurusan</th>
                <th>Status</th>
                <th>Harga</th>
                <th>Tampil</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                @php $st = $product->sale_status ?? 'portofolio'; @endphp
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="" class="dx-rank__img">
                            @else
                                <div class="dx-rank__img dx-rank__img--empty"><i class="bi bi-box-seam"></i></div>
                            @endif
                            <div>
                                <span class="dash-table-title d-block">{{ $product->title }}</span>
                                <small class="text-muted">{{ $product->team }} {{ $product->year ? '· ' . $product->year : '' }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $product->program?->code ?? '-' }}</td>
                    <td>
                        <span class="dx-chip" style="--chip: {{ $statusColor[$st] ?? '#0d2a5c' }}">{{ $product->status_label }}</span>
                    </td>
                    <td>{{ $product->price_label ?? '-' }}</td>
                    <td>
                        @if ($product->is_active)
                            <span class="dash-badge dash-badge-success">Aktif</span>
                        @else
                            <span class="dash-badge dash-badge-muted">Disembunyikan</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex">
                            <a href="{{ route('admin.products.edit', $product) }}" class="dash-action-btn"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin mau hapus produk ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="dash-action-btn dash-action-btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $products->links() }}</div>

@endsection