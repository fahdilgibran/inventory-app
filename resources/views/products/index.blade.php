@extends('layouts.main')
@php use Illuminate\Support\Str; @endphp

@section('content')
<!-- Notifikasi -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Daftar Barang Inventaris</h4>
        <div>
            <a href="/insert" class="btn btn-success btn-sm me-2">
                <i class="fas fa-bolt"></i> Otomatis
            </a>
            <a href="/products/create" class="btn btn-light btn-sm text-primary">
                <i class="fas fa-plus"></i> Manual
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <!-- Nomor yang benar saat pagination -->
                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                    
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category->name ?? '-' }}</td>
                    <td>Rp {{ number_format($p->price) }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>{{ Str::limit($p->description, 60) ?? '-' }}</td>
                    <td>
                        @if($p->status == 'tersedia')
                            <span class="badge bg-success">Tersedia</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    <td>
                        <a href="/products/{{ $p->id }}/edit" class="btn btn-warning btn-sm me-1">Edit</a>
                        <a href="/delete/{{ $p->id }}" 
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus produk ini?')">
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection