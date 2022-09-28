<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\User;
use App\Comment;
use DB;
use URL;

class IndexController extends Controller
{
    public function index()
    {
        $categoria=Category::all();
        return view('index', compact('categoria'));
    }
}
?>