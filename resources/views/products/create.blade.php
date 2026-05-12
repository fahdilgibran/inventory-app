@extends('layouts.main')

@section('content')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4>Tambah Produk Baru</h4>
    </div>
    <div class="card-body">
        <form action="/products/store" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" class="form-control bg-light" 
                       value="Otomatis berdasarkan stok" readonly>
                <small class="text-muted">Jika stok = 0 maka status "habis", jika > 0 maka "tersedia"</small>
            </div>

            <button type="submit" class="btn btn-success">Simpan Data</button>
            <a href="/products" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection