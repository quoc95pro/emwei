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

Route::get('/', 'pageController@index' );
Route::get('readAll',function (){
    $post = \App\tbl_anh::all();
    foreach ($post as $p){
        return $p->link;
    }
} );

Route::get('/',[
    'as'=>'trang-chu',
    'uses'=>'PageController@index'
]);

Route::get('dang-nhap',[
    'as'=>'dang-nhap',
    'uses'=>'PageController@login'
]);