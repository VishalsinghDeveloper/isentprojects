<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Templates;

class TemplateController extends Controller
{
    public function index()
    {
        $template = Templates::all();
        return view('admin.pages.templates.templates', ['template' => $template]);
    }

    public function Store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $Templates = new Templates();
        $Templates->description = $request->input('description');
        $Templates->save();
        return redirect(route('index-template'))->with('success', 'Template store successfully.');
    }
    public function add()
    {
        return view('admin.pages.templates.add');
    }

    public function edit($id)
    {
        $template = Templates::findOrFail($id);
        return view('admin.pages.templates.edit',['template'=> $template]);
    }

    public function update(Request$request, $id)
    {
        $templates = Templates::findOrFail($id);
        $templates->description =$request->description;
        $templates->update();
        return redirect(route('index-template'))->with('success', 'Template updated successfully.');;
    }

    public function destroy($id)
    {
        $template = Templates::findOrFail($id);
        $template->delete();
        return redirect(route('index-template'))->with('success', 'Template deleted successfully.');
    }
}
