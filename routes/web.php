<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
Route::get('/practice', function () {
    return '<center><b><h1>Viewtiful Pinas</h1></b></center>';    
});
*/
Auth::routes();
//pages
Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/todoList', 'PagesController@todoList');

//posts
Route::get('/posts','PostsController@index');
Route::post('/posts/create','PostsController@create');
Route::post('savepost','PostsController@savepost')->name('savepost');
Route::post('editpost','PostsController@editpost')->name('editpost');
Route::post('/viewpost','PostsController@viewpost')->name('viewpost');
Route::post('/posts/update','PostsController@updatepost')->name('updatepost');
Route::post('destroy','PostsController@destroy')->name('destroy');
Route::resource('posts', 'PostsController');
Route::get('postTable','PostsController@postTable')->name('postTable');



//profile
Route::get('/profile', 'ProfileController@index');
Route::post('profile', 'ProfileController@updateProfile');

//comment
Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');
//task
Route::get('/todoList', "TaskController@index");
Route::post("/todoList", "TaskController@store");
Route::get("/{id}/complete", "TaskController@complete");
Route::get("/{id}/delete", "TaskController@destroy");

//Profiles edit
Route::get('users/edit',  ['as' => 'users.edit', 'uses' => 'ProfileController@edit']);
Route::resource('users',  'ProfileController');

//Route::resource('profile','ProfileController');

//likes &dislikes
Route::get('like/{id}', 'PostsController@like');
Route::get('dislike/{id}', 'PostsController@dislike');


//Itinerary
Route::resource('itineraries','ItineraryController');
Route::get('itineraries/show/{provinces_id}', 'ItineraryController@show');
Route::get('itineraries/provinces/{id}', 'ItineraryController@provinces');
Route::get('/itineraries.index', 'ItineraryController@search');
Route::post('/itineraries', 'ItineraryController@store')->name('saveItineraries');

/*facebook
Route::get('facebook', function () {
    return view('facebook');
});
Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');
*/

//admin Auth Route
Route::get('admin-login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin-login', 'Admin\Auth\LoginController@login');
//Admin Pages
//Route::get('/admin/home', 'Admin\HomeController@home')->name('admin.pages.home');

Route::group(['namespace'=>'Admin','middleware'=>'auth:admin'],function(){
    Route::get('/admin/home', 'AdminHomeController@home')->name('admin.home');
    Route::get('/admin/useraccounts' , 'UserController@index');
});