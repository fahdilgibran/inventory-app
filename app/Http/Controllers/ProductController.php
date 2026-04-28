<?php

namespace App\Http\Controllers;

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
        $product = new Product();
        $product->category_id = \App\Models\Category::inRandomOrder()->first()->id;
        $product->name        = 'Produk UTS ' . rand(100, 999);
        $product->price       = rand(500000, 5000000);
        $product->stock       = rand(10, 150);
        $product->description = 'Deskripsi produk ini dibuat otomatis untuk keperluan UTS Web Framework';
        $product->status      = 'habis';
        $product->save();

        return redirect('/products')
            ->with('success', '1 data produk berhasil ditambahkan secara otomatis');
    }

    public function update($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect('/products')->with('error', 'Data produk tidak ditemukan');
        }

        $product->description = 'Deskripsi telah diupdate untuk UTS - ' . now()->format('d M Y H:i:s');
        $product->save();

        return redirect('/products')
               ->with('success', 'Deskripsi produk berhasil diupdate!');
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