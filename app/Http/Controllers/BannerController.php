<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function add()
    {
        return view('admin.banner.add');
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'banner_icon' => 'required|image', // File validation
            'status' => 'required|in:1,0', // Ensure status is either 1 or 0
            'order' => 'required|integer', // Validate order as integer
            'view' => 'required|in:mobile,desktop', // Ensure view is either mobile or desktop
        ]);

        if ($req->hasFile('banner_icon')) {
            $file = $req->file('banner_icon');
            $fileName = time() . '.' . $file->extension();
            $file->move('admin-files/banners/', $fileName);
        }

        $data =  Banner::insert([
            'image' => $fileName,
            'status' => $req->status,
            'view' => $req->view,
            'order' => $req->order,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        if ($data) {
            return redirect()->back()->with('status', 'success')->with('msg', 'Banner uploaded  successfully!');
        } else {
            return redirect()->back()->with('status', 'error')->with('msg', 'Failed to upload banner!');
        }
    }

    public function view()
    {
        $banners = Banner::all();
        return view('admin.banner.view', compact('banners'));
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $req, $id)
    {
        $banner = Banner::findOrFail($id);

        $validated = $req->validate([
            'status' => 'required|in:1,0', // Ensure status is either 1 or 0
            'order' => 'required|integer', // Validate order as integer
            'view' => 'required|in:mobile,desktop', // Ensure view is either mobile or desktop
        ]);

        $banner->order = $req->order;
        $banner->status = $req->status;
        $banner->view = $req->view;
        $banner->update();
        return redirect()->route('viewBanner')->with('status', 'success')->with('msg', 'Banner updated successfully!');
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        $path =  'admin-files/banners/' . $banner->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        if ($banner->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Banner deleted successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete banner.'
            ]);
        }
    }
}
