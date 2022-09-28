<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        $categoria=Category::all();
        return view('home', compact('categoria'));
    }
}
