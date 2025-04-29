<?php

namespace App\Http\Controllers\Home;

use App\Models\Banner;
use App\Models\Brands;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewProductController extends Controller
{

    public function homePage()
    {
        $featuredProducts = Product::where('trending', 1)->where('status',1)->latest()->take(6)->get();
        $latestProducts = Product::where('status',1)->latest()->take(4)->get();
        $brands = Brands::where('brand_status',1)->where('slug','!=','cicada')->get();
        $category_products = Category::where('status', 1)
            ->with(['product' => function ($query) {
                $query->where('status', 1);
            }])->get();
        $mobBanner = Banner::where('view','mobile')->where('status','1')->orderBy('order','asc')->get();    
        $deskBanner = Banner::where('view','desktop')->where('status','1')->orderBy('order','asc')->first();    

        return view('index', compact('category_products', 'featuredProducts','latestProducts','brands','mobBanner','deskBanner'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $related_product = Product::where('category_id',$product->category->id)
                ->where('slug','!=',$slug)->latest()->take(4)->get();
        return view('product.show', compact('product','related_product'));
    }

 
}
