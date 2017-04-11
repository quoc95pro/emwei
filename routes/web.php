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

Route::get('contact-us',[
    'as'=>'contact-us',
    'uses'=>'PageController@contactUs'
]);

Route::get('checkout',[
    'as'=>'checkout',
    'uses'=>'PageController@checkout'
]);

Route::get('cart',[
    'as'=>'cart',
    'uses'=>'PageController@cart'
]);

Route::get('blog',[
    'as'=>'blog',
    'uses'=>'PageController@blog'
]);

Route::get('blog-single',[
    'as'=>'blog-single',
    'uses'=>'PageController@blogSingle'
]);

Route::get('404',[
    'as'=>'404',
    'uses'=>'PageController@error404'
]);

Route::get('detail',[
    'as'=>'detail',
    'uses'=>'PageController@detail'
]);

Route::get('shop',[
    'as'=>'shop',
    'uses'=>'PageController@shop'
]);

Route::get('list-product/phone',[
    'as'=>'list-product/phone',
    'uses'=>'PageController@listProductPhone'
]);

Route::get('detail-product/{id}',[
    'as'=>'detail-product',
    'uses'=>'PageController@getDetail'
]);

Route::get('admin',[
    'as'=>'admin-index',
    'uses'=>'PageController@admin'
]);

Route::get('widgets',[
    'as'=>'widgets',
    'uses'=>'PageController@widgets'
]);

Route::get('charts',[
    'as'=>'charts',
    'uses'=>'PageController@charts'
]);

Route::get('tables',[
    'as'=>'tables',
    'uses'=>'PageController@tables'
]);

Route::get('forms',[
    'as'=>'forms',
    'uses'=>'PageController@forms'
]);

Route::get('panels',[
    'as'=>'panels',
    'uses'=>'PageController@panels'
]);

Route::get('icons',[
    'as'=>'icons',
    'uses'=>'PageController@icons'
]);

Route::get('login-admin',[
    'as'=>'login-admin',
    'uses'=>'PageController@loginAdmin'
]);