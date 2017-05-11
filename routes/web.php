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
use Illuminate\Http\Request;
use App\Customer;

Route::get('/', 'pageController@index' );
Route::get('readAll',function (){
    $post = \App\tbl_anh::all();
    foreach ($post as $p){
        return $p->link;
    }
} );

Route::post('/test',[
    'as'=>'test',
    'uses'=>'PageController@test'
]);

Route::get('/',[
    'as'=>'trang-chu',
    'uses'=>'PageController@index'
]);

Route::get('dang-nhap',[
    'as'=>'dang-nhap',
    'uses'=>'PageController@login'
]);

Route::post('post-login',[
    'as'=>'post-login',
    'uses'=>'PageController@postLogin'
]);

Route::get('dang-ky',[
    'as'=>'dang-ky',
    'uses'=>'PageController@signUp'
]);

Route::post('post-signup',[
    'as'=>'post-signup',
    'uses'=>'PageController@postSignUp'
]);

Route::get('contact-us',[
    'as'=>'contact-us',
    'uses'=>'PageController@contactUs'
]);

Route::get('checkout',[
    'as'=>'checkout',
    'uses'=>'PageController@checkout'
]);

Route::post('postCheckOut',[
    'as'=>'postCheckOut',
    'uses'=>'PageController@postCheckOut'
]);

Route::get('cart',[
    'as'=>'cart',
    'uses'=>'PageController@cart'
]);

Route::post('/cart-update-qty',[
    'as'=>'cart-update-qty',
    'uses'=>'PageController@cart_update_qty'
]);

Route::post('/cart-delete',[
    'as'=>'cart-delete',
    'uses'=>'PageController@cart_delete'
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

Route::get('list-product/{type}',[
    'as'=>'list-product/type',
    'uses'=>'PageController@listProduct'
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
Route::post('postLoginAdmin',[
    'as'=>'postLoginAdmin',
    'uses'=>'PageController@postLoginAdmin'
]);

Route::get('logOutAdmin',[
    'as'=>'logOutAdmin',
    'uses'=>'PageController@logOutAdmin'
]);

Route::get('all-product',[
    'as'=>'adminAllProduct',
    'uses'=>'PageController@adminAllProduct'
]);

Route::get('add-product',[
    'as'=>'adminAddProduct',
    'uses'=>'PageController@adminAddProduct'
]);

Route::post('add',[
    'as'=>'add',
    'uses'=>'PageController@add'
    ]);

Route::get('/json',function (){
    $product = \App\Product::get(['IDSanPham','TenSanPham','Gia','TinhTrang']);
    return $product->toJson();
});

Route::get('edit-product/{id}',[
    'as'=>'edit-product',
    'uses'=>'PageController@getEditProduct'
]);

Route::post('edit',[
    'as'=>'edit',
    'uses'=>'PageController@postEditProduct'
]);

Route::get('delete-product/{id}',[
    'as'=>'delete-product',
    'uses'=>'PageController@getDeleteProduct'
]);

Route::get('getAddProductType',[
    'as'=>'getAddProductType',
    'uses'=>'PageController@getAddProductType'
]);

Route::post('add-productType',[
    'as'=>'add-ProductType',
    'uses'=>'PageController@postAddProductType'
]);


Route::get('logout',[
    'as'=>'logout',
    'uses'=>'PageController@logout'
]);

Route::get('add-cart/{id}',[
    'as'=>'add-cart',
    'uses'=>'PageController@addCart'
]);
