<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ViewProductController extends Controller
{
    //

    // public function featureProducts()
    // {

    //     $featuredProducts = Product::where('trending', 1)->get();
    //     return view('index', compact('featuredProducts'));
    // }

    public function homePage()
    {
        $featuredProducts = Product::where('trending', 1)->take(6)->get();
        $brands = Brands::where('brand_status',1)->where('slug','!=','cicada')->get();
        $category_products = Category::where('status', 1)
            ->with(['product' => function ($query) {
                $query->where('status', 1);
            }])->get();

        return view('index', compact('category_products', 'featuredProducts' ,'brands'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $related_product = Product::where('category_id',$product->category->id)
                ->where('slug','!=',$slug)->latest()->take(4)->get();
        return view('product.show', compact('product','related_product'));
    }

 
}
