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

// vue routes to get all posts
Route::get('getPosts','PostController@getAllPosts');
// vue routes to get trending posts
Route::get('getTrendingPosts','PostController@getTrendingPosts');
// vue routes to get my posts
Route::get('getMyPosts','PostController@getMyPosts');
// vue route to like
Route::post('saveLike/{id}','PostController@saveLike');
// vue route to delete post
Route::post('deletePost/{id}','PostController@deletePost');

// user middleware start---------------------------------
Route::group(['middleware' => 'auth'], function(){

  Route::resource('posts','PostController');

  // routes for profile
  Route::get('/profile/{slug}', 'ProfileController@index');

  Route::get('/changePhoto', function(){
    return view('profile.pic');
  });

  Route::post('/uploadPhoto','ProfileController@uploadPhoto');

  Route::get('/changePassword', function(){
    return view('profile.changepassword');
  });

  Route::post('/uploadPassword','ProfileController@uploadPassword');

  Route::get('/editProfile', 'ProfileController@editProfileForm');

  Route::post('/updateProfile','ProfileController@updateProfile');

  //save image
  Route::post('/saveImg', 'PostController@saveImg');
  // routes for profile end

}); //-------------------------------user middleware end

Route::get('/contact', 'PagesController@getContact');
Route::get('/about', 'PagesController@getAbout');
Route::get('/', 'PagesController@getIndex');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
