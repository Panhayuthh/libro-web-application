<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        return view('admin.index');
        // return MenuItem::all();
    }

    public function create()
    {
        // return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        return MenuItem::create($request->all());
    }

    public function edit(MenuItem $menuItem)
    {
        // return view('admin.edit', compact('menuItem'));
        return $menuItem;
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $menuItem->update($request->all());

        return $menuItem;
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return response()->json(null, 204);
    }
}
