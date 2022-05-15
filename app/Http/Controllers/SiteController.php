<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $main_categories = Category::with('children')->whereNull('parent_id')->take(11)->get();
        $latest_product = Product::with('category')->OrderByDesc('created_at')->take(3)->get();

        return view('site.index', compact('main_categories', 'latest_product'));
    }

    public function Category($id)
    {
        $category = Category::findOrFail($id);
        return view('site.category', compact('category'));
    }

    public function Product($id)
    {
        $products = Product::findOrFail($id);
        return view('site.product', compact('products'));
    }
}
