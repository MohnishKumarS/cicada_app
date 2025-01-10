<?php

namespace App\Http\Controllers\Home;

use App\Models\Brands;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    public function index()
    {
        $category_collections = Category::where('status', 1)->get();
        return view('home-parts.collections', compact('category_collections'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->product()->where('status', 1)->get();
        return view('home-parts.collection-product', compact('category', 'products'));
    }

    // brand product
    public function brandProducts($slug){
        $brand = Brands::where('slug', $slug)->firstOrFail();
        // return $brand->product();
        $category = 0;
        $products = $brand->product()->where('status', 1)->get();
        return view('home-parts.collection-product', compact('brand','category','products'));
    }

}
