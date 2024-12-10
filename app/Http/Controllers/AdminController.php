<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    public function index()
    {
        return app(menuItemController::class)->index();
        // return MenuItem::all();
    }

    public function create()
    {
        // return view('admin.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->notValid) {
            return redirect()->back()->with('error', 'Invalid input');
        }

        if (MenuItem::where('name', $request->name)->exists()) {
            return redirect()->back()->with('error', 'Menu item already exists');
        }

        $imagePath = $request->hasFile('image') 
        ? $request->file('image')->store('menu_images', 'public') 
        : null;

        $menuItem = new MenuItem([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        try {
            $menuItem->save();
            return redirect()->route('admin.dashboard')->with('success', 'Menu item added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ];
    
        if ($request->hasFile('image')) {
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }

            $updateData['image'] = $request->file('image')->store('menu_images', 'public');
        }
    
        $menuItem->update($updateData);
    
        return redirect()->route('admin.dashboard')->with('success', 'Menu item updated successfully');
    }    

    public function destroy($id) {
        
        try {
            $menuItem = MenuItem::findOrFail($id);
    
            $menuItem->delete();
    
            return response('Menu item removed successfully', 200);
        } catch (ModelNotFoundException $e) {
            return response($e->getMessage(), 404);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
