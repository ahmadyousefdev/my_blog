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


Route::get('/', 'ArticleController@index')->name('main_index');

Route::get('/article/{id}', 'ArticleController@show')->name('show_article');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin / create , store , update, delete
// User  / index , show 


// prefix /admin/create .. /admin/strore .. /admin/update ....

Route::group(['prefix'=>'admin','middleware'=>'auth'],function () {
    Route::get('/', 'HomeController@index')->name('admin_index');
    Route::get('/create', 'ArticleController@create')->name('article_create');
    Route::post('/store', 'ArticleController@store')->name('article_create');
    Route::get('/edit/{id}', 'ArticleController@edit')->name('article_edit');
    Route::put('/update/{id}', 'ArticleController@update')->name('article_create');
    Route::put('/delete', 'ArticleController@destroy')->name('article_create');
});