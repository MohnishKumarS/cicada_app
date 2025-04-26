<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function add()
    {
        $brands = Brands::where('brand_status', 1)->get();
        $category = Category::where('status', 1)->get();

        return view('admin.product.add-product', compact('brands', 'category'));
    }

    public function store(Request $request)
    {

        $product = new Product();

        $request->validate([
            'product_name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug',
            'product_description' => 'nullable|string',
            'sizes' => 'nullable|array',
            'sizes.*' => 'in:s,m,l,xl,xxl',
            'quantity' => 'required|integer|min:1',
            'actual_price' => 'required|integer|min:0',
            'offer_price' => 'required|integer|min:0',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'main_img' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'trending' => 'required|in:1,2',
            'colors' => 'nullable|string',
        ]);


        $product->product_name = $request->input('product_name');

        $slug = $request->input('slug') ?: $request->input('product_name');
        $product->slug = Str::slug($slug);

        $product->product_description = $request->input('product_description');
        $product->size = is_array($request->input('sizes')) ? implode(',', $request->input('sizes')) : null;
        $product->quantity = $request->input('quantity');
        $product->actual_price = $request->input('actual_price');
        $product->offer_price = $request->input('offer_price');
        $product->brand_id = $request->input('brand_id');
        $product->category_id = $request->input('category_id');
        $product->trending = $request->input('trending');
        $product->color = $request->input('colors') ?: null;
        $product->status = 1;


        if ($request->hasFile('main_img')) {
            $file = $request->file('main_img');
            $extension = $file->getClientOriginalExtension();
            $formattedProductName = Str::slug($request->input('product_name'), '_');
            $mainImageName = $formattedProductName . '_' . time() . '.' . $extension;
            //$mainImageName = time() . '.' . $extension;
            $file->move("admin-files/products/", $mainImageName);
            $product->main_img = $mainImageName;
        }

        $additionalImages = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $formattedProductName = Str::slug($request->input('product_name'), '_');
                $imgName = $formattedProductName . '_' . time() . '_' . uniqid() . '.' . $extension;
                //$imgName = time() . '_' . uniqid() . '.' . $extension;
                $image->move("admin-files/products/", $imgName);
                $additionalImages[] = $imgName;
            }
            $product->additional_images = implode(',', $additionalImages);
        }

        $product->save();


        return redirect()->back()->with('msg', 'Product added successfully!');
    }

    public function view()
    {
        $products = Product::latest()->get();
        // dd($products);
        return view('admin.product.view-product', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brand = Brands::where('brand_status', 1)->get();
        $category = Category::where('status', 1)->get();
        return view('admin.product.edit-product', compact('product', 'brand', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'slug' => 'nullable|string|unique:products,slug,' . $id,
            'product_description' => ['nullable', 'string'],
            'sizes' => 'nullable|array',
            'sizes.*' => 'in:s,m,l,xl,xxl',
            'quantity' => 'required|integer|min:1',
            'actual_price' => 'required|integer|min:1',
            'offer_price' => 'nullable|integer|min:1',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'trending' => 'required|in:1,2',
            'colors' => ['nullable','string'],
            
        ]);

        $product =  Product::findOrFail($id);

        $product->product_name = $request->input('product_name');

        $slug = $request->input('slug') ?: $request->input('product_name');
        $product->slug = Str::slug($slug);

        $product->product_description = $request->input('product_description');
        $product->size = is_array($request->input('sizes')) ? implode(',', $request->input('sizes')) : null;
        $product->quantity = $request->input('quantity');
        $product->actual_price = $request->input('actual_price');
        $product->offer_price = $request->input('offer_price');
        $product->brand_id = $request->input('brand_id');
        $product->category_id = $request->input('category_id');
        $product->trending = $request->input('trending');        
        $product->color = $request->input('colors');

        $product->status = 1;


        if ($request->hasFile('main_img')) {
            $file = $request->file('main_img');
            $extension = $file->getClientOriginalExtension();
            $formattedProductName = Str::slug($request->input('product_name'), '_');
            $mainImageName = $formattedProductName . '_' . time() . '.' . $extension;
            //$mainImageName = time() . '.' . $extension;
            $file->move("admin-files/products/", $mainImageName);
            $product->main_img = $mainImageName;
        }

        $additionalImages = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $formattedProductName = Str::slug($request->input('product_name'), '_');
                $imgName = $formattedProductName . '_' . time() . '_' . uniqid() . '.' . $extension;
               // $imgName = time() . '_' . uniqid() . '.' . $extension;
                $image->move("admin-files/products/", $imgName);
                $additionalImages[] = $imgName;
            }
            $product->additional_images = implode(',', $additionalImages);
        }
        $product->save();

        return redirect()->route('view-products')->with('msg', 'Product updated successfully.');
    }

    public function toggleStatus(Request $request, $id){
        $product = Product::findOrFail($id);
        if ($product) {
            $product->status = $request->status;
            $product->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'category not found.']);
    }


    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            if ($product->main_img) {
                File::delete('admin-files/products/' . $product->main_img);
            }
        
            if($product->additional_images){
                $additionalImages = explode(',', $product->additional_images);
                foreach ($additionalImages as $image) {
                    File::delete('admin-files/products/'. $image);
                }
            }
            $product->delete();
            return response()->json(['success' => true, 'message' => 'product deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'product not found']);
    }

}
