<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function insert()
    {
        $categoryIds = \App\Models\Category::pluck('id');

        if ($categoryIds->isEmpty()) {
            return redirect('/products')
                ->with('error', 'Belum ada kategori. Silakan tambah kategori terlebih dahulu.');
        }

        $product = new \App\Models\Product();
        $product->category_id = $categoryIds->random();   // ← Cara yang kamu minta
        $product->name        = 'Produk UTS ' . rand(100, 999);
        $product->price       = rand(150000, 3500000);
        $product->stock       = rand(5, 100);
        $product->description = 'Data ini dibuat otomatis melalui method insert() untuk keperluan UTS';
        $product->status      = 'tersedia';
        $product->save();

        return redirect('/products')
            ->with('success', '1 data produk baru berhasil ditambahkan secara otomatis!');
    }

        // Menampilkan Form Tambah Data Manual
        // CREATE - Menampilkan Form
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('products.create', compact('categories'));
    }

    // STORE - Simpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $status = $request->stock > 0 ? 'tersedia' : 'habis';

        Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'status'      => $status,           // otomatis
        ]);

        return redirect('/products')
               ->with('success', 'Data produk berhasil ditambahkan!');
    }

    // EDIT - Menampilkan Form Edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = \App\Models\Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    // UPDATE - Simpan Perubahan
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $status = $request->stock > 0 ? 'tersedia' : 'habis';

        $product->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'status'      => $status,           // otomatis
        ]);

        return redirect('/products')
               ->with('success', 'Data produk berhasil diupdate!');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect('/products')->with('error', 'Data produk tidak ditemukan');
        }

        $product->delete();

        return redirect('/products')
               ->with('success', 'Data produk berhasil dihapus');
    }
}