<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Publicaciones
Route::resource('post', 'PostsController');
Route::post('/like-post','PostsController@likePost');
Route::post('/share-post','PostsController@sharePost');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/accept-request', 'HomeController@acceptRequest')->name('acceptRequest');
Route::post('/reject-request', 'HomeController@rejectRequest')->name('rejectRequest');


Route::middleware(['auth'],)->group(function(){
    //Profesionales
    Route::resource('profesional', 'ProfesionalsController');
    Route::post('/follow-profesional','ProfesionalsController@followProfesional');
    //Company
    Route::resource('company', 'CompaniesController');
    Route::post('/follow-profile','CompaniesController@followProfile');
    Route::post('/send-request','CompaniesController@sendRequest');
    //Brand
    Route::resource('brand', 'BrandsController');
    //Members
    Route::resource('member', 'MembersController');
});
