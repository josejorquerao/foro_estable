<?php
use Illuminate\Support\Facades\Route;

//Inicio
Auth::routes();
Route::get('/','IndexController@index');
Route::get('/home', 'HomeController@home')->name('home');

//Listar
Route::get('/posts/{id}','PostController@posts')->name('posts');//Posts por categoria
Route::get('/listpost','PostController@listPost');//Listar tabla vista posts por AJAX
Route::get('/post/{id}','PostController@post')->name('post');//Detalle post, seccion comentarios

//Ruta AJAX insertar, eliminar Post.
Route::resource('post','PostController');
Route::resource('cmt','CommentController');
Route::get('/listcmt','CommentController@listCmt');//Listar comentarios por AJAX

//Insertar
Route::post('/crearcmt', 'CommentController@insertarCmt')->name('crearcmt');
Route::post('/crearcat', 'CategoryController@insertarCat')->name('crearcat');

//Eliminar
//Route::delete('/borrarcmt/{id}', 'CommentController@borrarCmt')->name('borrarcmt');
Route::delete('/borrarcat/{id}', 'CategoryController@borrarCat')->name('borrarcat');

//Editar
Route::put('/editarcat/{id}','CategoryController@editarCat')->name('editarcat');
Route::get('/datospost','PostController@editmostrar')->name('datospost');//Mostrar post seleccionado
Route::put('/editarpost','PostController@edit')->name('editarpost');//Actualizar post seleccionado
Route::get('/datoscmt','CommentController@editmostrar')->name('datoscmt');//Mostrar cmt seleccionado
Route::put('/editarcmt','CommentController@edit')->name('editarcmt');//Actualizar cmt seleccionado
//Route::put('/editarcmt/{id}','CommentController@editarCmt')->name('editarcmt');



//Likes - Post
Route::get('/likepost', 'PostController@addLikePost');

//Likes - Comment
Route::get('/likecmt', 'CommentController@addLikeCmt');

//Añadir post a favoritos
Route::post('addfavorite' , 'PostController@AddFavPost');

//Vista favoritos
Route::get('myfavorites', 'PostController@userFavorites');
Route::get('myposts', 'PostController@userPosts');


