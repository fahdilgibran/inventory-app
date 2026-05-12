@extends('layouts.main')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning text-dark">
        <h4>Edit Produk: {{ $product->name }}</h4>
    </div>
    <div class="card-body">
        <form action="/products/{{ $product->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" 
                            {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="name" class="form-control" 
                       value="{{ $product->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" 
                       value="{{ $product->price }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" 
                       value="{{ $product->stock }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" class="form-control bg-light" 
                       value="{{ $product->status }}" readonly>
                <small class="text-muted">Status diatur otomatis berdasarkan stok</small>
            </div>

            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="/products" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection