<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\User;
use App\Comment;
use App\LikeCmt;
use DB;
use URL;

class CommentController extends Controller
{
    public function listCmt(Request $request)
    {
        $id=$request->input('id');
        $comment=Post::find($id)->comment;
        return view('list-cmt')->with('comment',$comment);
    }
    public function insertarCmt(Request $request)
    {
        $crearCmt = Comment::create([
            'comment'=>$request->get('comment'),
            'post_id'=>$request->get('posteo'),
            'users_id'=>auth()->user()->id,
        ]);
        return back()->with('mensaje','Comentario creado.');  
    }
    public function borrarCmt($id)
    {
        $borrarCmt = Comment::find($id);
        $borrarCmt->delete();
        return back()->with('mensaje','Comentario eliminado.'); 

    }
    public function editarCmt(Request $request, $id)
    {
        $editarCmt=Comment::find($id);
        $editarCmt->comment=$request->get('comment');
        $editarCmt->save();
        return back()->with('mensaje','Comentario editado.'); 

    }
    //Insertar
    public function store(Request $request)
    {
        if ($request->ajax()){
            $crearCmt = Comment::Create([
                'comment'=>$request->get('comment'),
                'users_id'=>auth()->user()->id,
                'post_id'=>$request->get('post_id'),
            ]);  
            return response()->json(['success'=>'true']);
            }
    }
    public function destroy($id)
    {   
        $cmt = Comment::find($id);
        $result = $cmt->delete();
        if ($result){
            return response()->json(['success'=>'true']);
        } 
        else
        {
          return response()->json(['success'=>'false']);  
        }
    }
    public function edit(Request $request)
    {
        if ($request->ajax())
        {
          $cmt = Comment::find($request->input('cmt'));
          $cmt->comment=$request->get('comment');
          $cmt->save();
          return response()->json($cmt);
        }
    }
    public function editmostrar(Request $request)
    {
        $id=$request->input('id');
        $data=Comment::
        select('comment')
        ->where('id','=',$id)
        ->get();
        $array["aa"]=[$data[0]->comment];
        return json_encode($array);
    }

    public function addLikeCmt() {
        $idCmt = request('idCmt');
        $idUser = auth()->user()->id;
        $is_like = request('isLike');
        $cmt = Comment::findOrFail($idCmt);

        $like = LikeCmt::where('users_id',$idUser)
        ->where('comment_id',$idCmt)
        ->where('like',1)
        ->first();
        $disLike = LikeCmt::where('users_id',$idUser)
        ->where('comment_id',$idCmt)
        ->where('like',0)
        ->first();

        $addIsLike = new LikeCmt();
        $addIsLike->like = $is_like;
        $addIsLike->users_id = $idUser;
        $addIsLike->comment_id = $idCmt;

        if($is_like==1)
        {
            if($disLike)
            {
                $disLike->delete();
                $cmt->dislikes = $cmt->dislikes-1;
                $addIsLike->save();
                $cmt->likes = $cmt->likes+1;
            }
            else
            {
                if($like)
                {
                    $like->delete();
                    $cmt->likes = $cmt->likes-1;
                }
                else
                {
                    $addIsLike->save();
                    $cmt->likes = $cmt->likes+1;
                }
                $cmt->save();
            }
            $cmt->save();
        }
        else
        {
            if($like)
            {
                $like->delete();
                $cmt->likes = $cmt->likes-1;
                $addIsLike->save();
                $cmt->dislikes = $cmt->dislikes + 1;
            }
            else
            {
                if($disLike)
                {
                    $disLike->delete();
                    $cmt->dislikes = $cmt->dislikes - 1;
                }
                else
                {
                    $addIsLike->save();
                    $cmt->dislikes = $cmt->dislikes + 1;
                }
                $cmt->save();
            }
            $cmt->save();
        }
        return response()->json(["cmt" => $cmt]);
    }
}
?>