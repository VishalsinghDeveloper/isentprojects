<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQ;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = FAQ::all();
        return view('admin.pages.faqs.faqs', compact('faqs'));
    }

    public function create()
    {
        return view('admin.pages.faqs.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        FAQ::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('faqs-index')->with('success', 'FAQ created successfully');
    }

    public function edit($id)
    {
        $faqs = FAQ::findOrFail($id);
        return view('admin.pages.faqs.edit', compact('faqs'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $faq = FAQ::findOrFail($id);
        $faq->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('faqs-index')->with('success', 'FAQ updated successfully');
    }
    public function destroy($id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->delete();

        return redirect()->route('faqs-index')->with('success', 'FAQ deleted successfully');
    }
}
