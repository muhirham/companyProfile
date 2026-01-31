<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();

        return view('admin.products.index', [
            'title'    => 'Produk Genset',
            'products' => $products,
        ]);
    }
}
