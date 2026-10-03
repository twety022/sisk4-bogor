<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Program;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // /produk
    public function index(Request $request)
    {
        $programSlug = $request->query('jurusan');

        $products = Product::active()
            ->with('program')
            ->when($programSlug, function ($query) use ($programSlug) {
                $query->whereHas('program', fn ($q) => $q->where('slug', $programSlug));
            })
            ->get();

        return view('products.index', [
            'products'      => $products,
            'programs'      => Program::active()->get(),
            'activeProgram' => $programSlug,
        ]);
    }
}
