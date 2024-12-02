<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class menuItemController extends Controller
{
    public function index()
    {
        // return view('menuItems.index');
        // return MenuItem::paginate(10);
        return MenuItem::all();
    }

    public function show(MenuItem $menuItem)
    {
        return $menuItem;
    }
}
