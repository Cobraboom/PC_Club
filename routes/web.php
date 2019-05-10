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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'PC_Club', 'prefix' => 'sessia'], function (){
    Route::resource('bron', 'PostController')->names('PC_Club.posts');
});



//Админка ПК Клуба

$groupData =[
    'namespace' => 'PC_Club\Admin',
    'prefix' => 'admin/PC_Club',
];
Route::group($groupData, function (){
    //PC_Club_PC
    $methods = ['index', 'edit', 'update', 'create', 'store',];
    Route::resource('PC', 'PC_Controller')
        ->only($methods)
        ->names('PC_Club.admin.PC');
});

Route::group($groupData, function (){
    //PC_Club_Ses
    $methods = ['index', 'edit', 'update', 'create', 'store',];
    Route::resource('Ses', 'Ses_Controller')
        ->only($methods)
        ->names('PC_Club.admin.Ses');
});

//Route::resource('rest', 'RestTestController')->names('restTest');

//Route::get('app', 'HomeController@index')->name('app');


