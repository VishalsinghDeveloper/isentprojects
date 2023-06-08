<?php

namespace App\Http\Controllers;

use App\Models\Policies;
use Illuminate\Http\Request;
use Exception;

class PoliciesController extends Controller
{
    public function index()
    {
        $policies = Policies::all();
        return view('admin.pages.policies.index', ['policies' => $policies]);
    }

    public function create()
    {
        return view('admin.pages.policies.add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $policies = new Policies;
        $policies->title = $request->title;
        $policies->description = $request->description;
        $policies->save();

        return redirect(route('policies-index'))->with('success', 'Policies Add Successfully');
    }

    public function edit($id)
    {
        $policies = Policies::find($id);
        return view('admin.pages.policies.edit', ['policies' => $policies]);
    }

    public function update(Request $request, $id)
    {
        $policies = Policies::find($id);
        $policies->title = $request->title;
        $policies->description = $request->description;
        $policies->update();

        return redirect(route('policies-index'))->with('success', 'Policies Updated Successfully');
    }

    public function view($id)
    {
        $policies = Policies::find($id);
        return view('admin.pages.policies.view', ['policies' => $policies]);
    }
}
