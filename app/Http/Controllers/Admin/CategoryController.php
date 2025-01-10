<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function add()
    {
        $brands = Brands::where('brand_status', 1)->get();
        return view('admin.category.add-category', compact('brands'));
    }

    public function store(Request $request)
    {
        $category = new Category();

        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:brands,slug',
            'brand_id' => 'required|integer',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $category->category_name = $request->input('category_name');

        $slug = $request->input('slug') ?: $request->input('category_name');
        
        $category->slug = Str::slug($slug);
        $category->slug = $request->input('slug');

        $category->status = $request->input('status', 1);
        $category->brand_id = $request->input('brand_id');

        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $extension = $file->getClientOriginalExtension();
            //$imgName = time() . '.' . $extension;
            $formattedCategoryName = Str::slug($request->input('category_name'), '_');
            $mainImageName = $formattedCategoryName . '_' . time() . '.' . $extension;
            $file->move("admin-files/category/", $mainImageName);
            $category->category_image = $mainImageName;
        }

        $category->save();

        return redirect()->back()->with('msg','category created successfully');
    }


    public function view(){
        $categories = Category::all();
        return view('admin.category.view-category', compact('categories'));
    }


    public function toggleStatus(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->status = $request->status;
            $category->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'category not found.']);
    }


    public function edit($id)
    {
        $category = Category::find($id);
        $brands = Brands::all();  
        return view('admin.category.edit-category', compact('category', 'brands'));
    }

    public function update (Request $request,$id){
        $request->validate([
            'category_name' => ['required','string','max:255'],
            'brand_id' => ['required','integer'],
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::find($id);
        $category->category_name = $request->input('category_name');
        $category->slug = Str::slug($request->input('category_name'));
        $category->brand_id = $request->input('brand_id');

        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $extension = $file->getClientOriginalExtension();
            $formattedCategoryName = Str::slug($request->input('category_name'), '_');
            $mainImageName = $formattedCategoryName . '_' . time() . '.' . $extension;
          //  $imgName = time(). '.'. $extension;
            $file->move("admin-files/category/", $mainImageName);
            $category->category_image = $mainImageName;
        }

        $category->save();

        return redirect()->route('view-category')->with('msg', 'category updated successfully');
    }


    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            if ($category->category_image) {
                File::delete('admin-files/category/' . $category->category_image);
            }
        
            $category->delete();
            return response()->json(['success' => true, 'message' => 'category deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'category not found']);
    }
}