<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\User;
use App\Comment;
use DB;
use URL;

class CategoryController extends Controller
{
    public function insertarCat(Request $request)
    {
        $crearCat = Category::create([
            'name'=>$request->get('name'),
            'description'=>$request->get('description'),
        ]);
        return back()->with('mensaje','Categoria creada.');  
    }
    public function borrarCat($id)
    {
        $borrarCat = Category::find($id);
        $borrarCat->delete();
        return back()->with('mensaje','Categoria eliminada.'); 

    }
    public function editarCat(Request $request, $id)
    {
        $editarCat=Category::find($id);
        $editarCat->name=$request->get('name');
        $editarCat->description=$request->get('description');
        $editarCat->save();
        return back()->with('mensaje','Categoria editada.'); 

    }

}
?>