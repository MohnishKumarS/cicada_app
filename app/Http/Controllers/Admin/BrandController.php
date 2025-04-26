<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brands;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{
    //

    public function add()
    {
        return view('admin.brands.add-brand');
    }


    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:brands,slug',
            'brand_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg,web|max:2048',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,web|max:2048',
        ]);

        $brands = new Brands();

        $brands->brand_name = $request->input('brand_name');
        $slug = $request->input('slug') ?: $request->input('brand_name');

        $brands->slug = Str::slug($slug);
        $brands->slug = $request->input('slug');

        $brands->brand_status = $request->input('brand_status', 1);

        if ($request->hasFile('brand_icon')) {
            $file = $request->file('brand_icon');
            $extension = $file->getClientOriginalExtension();
            $iconName = time() . '.' . $extension;
            $file->move("admin-files/brands/brand-icon/", $iconName);
            $brands->brand_icon = $iconName;
        }
        if ($request->hasFile('brand_image')) {
            $file = $request->file('brand_image');
            $extension = $file->getClientOriginalExtension();
            $imgName = time() . '.' . $extension;
            $file->move("admin-files/brands/brand-img/", $imgName);
            $brands->brand_img = $imgName;
        }
        $brands->save();

        return redirect()->back()->with("msg", "Brand Added Sucessfully");
    }

    public function view()
    {
        $brands = Brands::all();
        return view('admin.brands.view-brand', compact('brands'));
    }

    public function toggleStatus(Request $request, $id)
    {
        $brand = Brands::findOrFail($id);

        if ($brand) {
            $brand->brand_status = $request->brand_status;
            $brand->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Brand not found.']);
    }

    public function edit($id)
    {
        $brand = Brands::findOrFail($id);
        return view('admin.brands.edit-brand', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:brands,slug,' . $id, // unique except for this brand
            'brand_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $brand = Brands::findOrFail($id);


        $brand->brand_name = $request->input('brand_name');
        $brand->slug = Str::slug($request->input('brand_name'));
        if ($request->hasFile('brand_icon')) {
            if ($brand->brand_icon) {
                File::delete('admin-files/brands/brand-icon/'. $brand->brand_icon);
            }
            $iconFile = $request->file('brand_icon');
            $iconName = time() . '.' . $iconFile->getClientOriginalExtension();
            $iconFile->move('admin-files/brands/brand-icon', $iconName);
            $brand->brand_icon = $iconName;
        }

        if ($request->hasFile('brand_image')) {
            if ($brand->brand_img) {
                File::delete('admin-files/brands/brand-img/'. $brand->brand_img);
            }
            $imageFile = $request->file('brand_image');
            $imgName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move('admin-files/brands/brand-img', $imgName);
            $brand->brand_img = $imgName;
        }

        $brand->brand_status = $request->input('brand_status', 1); // Default active

        $brand->save();

        return redirect()->route('view-brand')->with('msg', 'Brand updated successfully');
    }

    public function delete($id)
    {
        $brand = Brands::findOrFail($id);

        if ($brand) {
            $categoryArr = Category::where('brand_id', $id)->get();
            // delete category
            if ($categoryArr->count() > 0) {
                foreach ($categoryArr as $category) {
                    if ($category->category_image) {
                        File::delete('admin-files/category/' . $category->category_image);
                    }
                    $category->delete();
                }
            }

            // delete products
            $productArr = Product::where('brand_id', $id)->get();
            if ($productArr->count() > 0) {
                foreach ($productArr as $product) {
                    if ($product->main_img) {
                        File::delete('admin-files/products/'. $product->main_img);
                    }
                    if($product->additional_images){
                        $additionalImages = explode(',', $product->additional_images);
                        foreach ($additionalImages as $image) {
                            File::delete('admin-files/products/'. $image);
                        }
                    }
                    $product->delete();
                }
            }

            // delete brand image and icon if exists
            if ($brand->brand_icon) {
                File::delete('admin-files/brands/brand-icon/'. $brand->brand_icon);
            }
            
            if ($brand->brand_img) {
                File::delete('admin-files/brands/brand-img/' . $brand->brand_img);
            }

            $brand->delete();

            return response()->json([
                'success' => true,
                'message' => 'Brand and associated categories & products deleted successfully.'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Brand not found.'
        ]);
    }
}
