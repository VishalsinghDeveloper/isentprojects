<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketingTips;
use Illuminate\Support\Facades\File;

class MarketingTipsController extends Controller
{
    public function index()
    {
        $marketingTips = MarketingTips::all();
        return view('admin.pages.marketing_tips.index', compact('marketingTips'));
    }

    public function create()
    {
        return view('admin.pages.marketing_tips.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'title' => 'required',
        ]);

        $marketingTip = new MarketingTips;
        $marketingTip->title = $request->title;
        $marketingTip->description = $request->description;
        if ($request->hasfile('images')) {
            $path = 'uploads/marketingTip/';
            $file = $request->file('images');
            $extention = $file->getClientOriginalExtension();
            $filename = $path . time() . '.' . $extention;
            $file->move('uploads/marketingTip/', $filename);
            $marketingTip->image = $filename;
        }
        $marketingTip->save();

        return redirect()->route('marketing_tips-index')->with('success', 'Marketing tips created successfully.');
    }

    public function edit($id)
    {
        $marketingTip = MarketingTips::find($id);
        return view('admin.pages.marketing_tips.edit', compact('marketingTip'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'title' => 'required',
        ]);
        $marketingTip = MarketingTips::find($id);
        $marketingTip->title = $request->title;
        $marketingTip->description = $request->description;
        if ($request->hasfile('images')) {
            $destination = 'uploads/marketingTip/' .  basename($marketingTip->image);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $path = 'uploads/marketingTip/';
            $file = $request->file('images');
            $extention = $file->getClientOriginalExtension();
            $filename = $path . time() . '.' . $extention;
            $file->move('uploads/marketingTip/', $filename);
            $marketingTip->image = $filename;
        }
        $marketingTip->update();

        return redirect()->route('marketing_tips-index')->with('success', 'Marketing tip updated successfully.');
    }

    public function destroy($id)
    {
        $marketingTip = MarketingTips::find($id);
        if ($marketingTip->image) {
            $destination = public_path('uploads/marketingTip/' .  basename($marketingTip->image));
            if (File::exists($destination)) {
                File::delete($destination);
            }
        }
        $marketingTip->delete();

        return redirect()->route('marketing_tips-index')->with('success', 'Marketing tip deleted successfully.');
    }

    public function view($id)
    {
        $marketingTips = MarketingTips::find($id);
        return view('admin.pages.marketing_tips.view', ['marketingTip' => $marketingTips]);
    }
}
