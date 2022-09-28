<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Post;
use App\User;
use App\Comment;
use App\Like;
use App\Favorite;
use DB;
use URL;
class PostController extends Controller
{
    public function userFavorites()
    {
        $userId=auth()->user()->id;
        return view('user-favorites');
    }
    public function userPosts()
    {
        $userId=auth()->user()->id;
        $posts = Post::where('users_id',$userId)->get();     
        return view('user-posts')->with('posts',$posts); 
    }
    public static function posts($id)
    {
        $cat=Category::find($id);
        return view('posts')->with('cat',$cat);    
    }
    public function post($id)
    {
        $post=Post::find($id);
        return view('post', compact('post'));      
    }
    public function listPost(Request $request)
    {
        $cat=$request->input('id');
        $posts=Category::find($cat)->posts;
        return view('list-post')->with('posts',$posts);
    }
    public function store(Request $request)
    {
        if ($request->ajax()){
            $crearPost = Post::updateOrCreate([
                'title'=>$request->get('title'),
                'content'=>$request->get('content'),
                'category_id'=>$request->get('category_id'),
                'users_id'=>auth()->user()->id,
            ]);
            
            return response()->json(['success'=>'true']);
            }
    }
    public function edit(Request $request)
    {
        if ($request->ajax())
        {
          $post = Post::find($request->input('cocos'));
          $post->title=$request->get('title');
          $post->content=$request->get('content');
          $post->save();
          return response()->json($post);
        }
    }
    public function editmostrar(Request $request)
    {
        $id=$request->input('id');
        $data=Post::
        select('title','content')
        ->where('id','=',$id)
        ->get();
        $array["aa"]=[$data[0]->title, $data[0]->content];
        return json_encode($array);
    }
    public function destroy($id)
    {   
        $post = Post::find($id);
        $result = $post->delete();
        if ($result){
            return response()->json(['success'=>'true']);
        } 
        else
        {
          return response()->json(['success'=>'false']);  
        }
    }
    public function addLikePost() {

        if (auth()->user())
        {
        $idPost = request('idPost');
        $idUser = auth()->user()->id;
        $is_like = request('isLike');
        $post = Post::findOrFail($idPost);

        $like = Like::where('users_id',$idUser)
        ->where('post_id',$idPost)
        ->where('like',1)
        ->first();
        $disLike = Like::where('users_id',$idUser)
        ->where('post_id',$idPost)
        ->where('like',0)
        ->first();

        $addIsLike = new Like();
        $addIsLike->like = $is_like;
        $addIsLike->users_id = $idUser;
        $addIsLike->post_id = $idPost;

        if($is_like==1)
        {
            if($disLike)
            {
                $disLike->delete();
                $post->dislikes = $post->dislikes-1;
                $addIsLike->save();
                $post->likes = $post->likes+1;
            }
            else
            {
                if($like)
                {
                    $like->delete();
                    $post->likes = $post->likes-1;
                }
                else
                {
                    $addIsLike->save();
                    $post->likes = $post->likes+1;
                }
                $post->save();
            }
            $post->save();
        }
        else
        {
            if($like)
            {
                $like->delete();
                $post->likes = $post->likes-1;
                $addIsLike->save();
                $post->dislikes = $post->dislikes + 1;
            }
            else
            {
                if($disLike)
                {
                    $disLike->delete();
                    $post->dislikes = $post->dislikes - 1;
                }
                else
                {
                    $addIsLike->save();
                    $post->dislikes = $post->dislikes + 1;
                }
                $post->save();
            }
            $post->save();
        }
        return response()->json(["post" => $post]);

        }
        else
        {
            return response()->json(["msg" => "Debes registrarte para activar esta funcionalidad"]);

        }       
    }
    public function addFavPost()
    {
        if(auth()->user())
        {
            $idPost = request('idPost');
            $idUser = auth()->user()->id;

            $registro = Favorite::where('users_id',$idUser)
            ->where('post_id',$idPost)
            ->first();
            
            if($registro)
            {
                $registro->delete();
                return response()->json(["msgdelete" => "Se borro el post de favoritos"]);
            }else
            {
                $addFavorite = new Favorite();
                $addFavorite->users_id = $idUser;
                $addFavorite->post_id = $idPost;
                $addFavorite->save();
                return response()->json(["msgsuccess" => "Se guardo el post en favoritos"]);
            }           
        }else
        {
            return response()->json(["msgfail" => "Debes registrarte para activar esta funcionalidad"]);

        }

    }
}
?>