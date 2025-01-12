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

    public function show(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $query  = $category->product()->where('status', 1);
        // Handle 'sortBy' parameter
        if ($request->has('sortBy')) {
            switch ($request->input('sortBy')) {
                case 'featured':
                    $query->where('trending', '1');
                    break;
                case 'latestsell':
                    $query->orderBy('id', 'desc');
                    break;
                case 'plow':
                    $query->orderBy('offer_price', 'asc');
                    break;
                case 'phigh':
                    $query->orderBy('offer_price', 'desc');
                    break;
            }
        }
        $products = $query->get();
        return view('home-parts.collection-product', compact('category', 'products'));
    }

    // brand product
    public function brandProducts(Request $request,$slug)
    {
        $brand = Brands::where('slug', $slug)->firstOrFail();
        $category = 0;
        $query = $brand->product()->where('status', 1);
        $query->when($request->input('sortBy') === 'featured', function ($q) {
            $q->where('trending', '1');
        });
        
        $query->when($request->input('sortBy') === 'latestsell', function ($q) {
            $q->orderBy('id', 'desc');
        });
        
        $query->when($request->input('sortBy') === 'plow', function ($q) {
            $q->orderBy('offer_price', 'asc');
        });
        
        $query->when($request->input('sortBy') === 'phigh', function ($q) {
            $q->orderBy('offer_price', 'desc');
        });
        
        $products = $query->get();
        return view('home-parts.collection-product', compact('brand', 'category', 'products'));
    }
}
