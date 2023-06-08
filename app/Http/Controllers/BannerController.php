<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class BannerController extends Controller
{
    public function index()
    {
        return view('admin.pages.banners.banner');
    }

    public function add_banners(Request $request)
    {
        $request->validate([
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $banners = new Banner;
        $banners->title = $request->title; 
        if ($request->hasfile('images')) {
            $path = '/uploads/banners/';
            $file = $request->file('images');
            $extention = $file->getClientOriginalExtension();
            $filename = $path . time() . '.' . $extention;
            $file->move('uploads/banners/', $filename);
            $banners->images = $filename;
        }
        $banners->save();

        return redirect(route('banners-show'))->with('success', 'Banner Created successfully');
    }

    public function show()
    {
        $banner = Banner::all();
        return view('admin.pages.banners.show', ['banners' => $banner]);
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.pages.banners.edit', ['banners' => $banner]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $banners = Banner::find($id);
        $banners->title = $request->title;
        if ($request->hasfile('images')) {
            $destination = 'uploads/banners/' . basename($banners->images);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $path = '/uploads/banners/';
            $file = $request->file('images');
            $extention = $file->getClientOriginalExtension();
            $filename =  $path . time() . '.' . $extention;
            $file->move('uploads/banners/', $filename);
            $banners->images = $filename;
        }
        $banners->update();
        return redirect(route('banners-show'))->with('success', 'Banner Updated successfully');
    }

    public function delete(Request $request, $id)
    {
        $banner = Banner::find($id);
        if ($request->has('images')) {
            $destination = 'uploads/banners/' .basename($banner->images);
            if (File::exists($destination)) {
                File::delete($destination);
            }
        }
        $banner->delete();
        return redirect()->back()->with('success', 'Banner Deleted successfully');
    }
}
