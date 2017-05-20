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
use App\Chart;
use App\Bill_Product;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Arr;

Route::get('/', 'pageController@index' );
Route::get('readAll',function (){
    $post = \App\tbl_anh::all();
    foreach ($post as $p){
        return $p->link;
    }
} );

Route::get('/test',function (){

    return redirect()-> route('all');
});

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

Route::get('chart',[
    'as'=>'chart',
    'uses'=>'PageController@chart'
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

Route::get('bills',[
    'as'=>'bills',
    'uses'=>'PageController@bills'
]);
Route::get('check-bill/{id}',[
    'as'=>'check-bill',
    'uses'=>'PageController@checkBill'
]);

Route::post('edit-bill',[
    'as'=>'edit-bill',
    'uses'=>'PageController@postEditBill'
]);

Route::post('/cart-update-qty-admin',[
    'as'=>'cart-update-qty-admin',
    'uses'=>'PageController@cart_update_qty_admin'
]);

Route::post('/cart-delete-admin',[
    'as'=>'cart-delete-admin',
    'uses'=>'PageController@cart_delete_admin'
]);

Route::get('add-product',[
    'as'=>'adminAddProduct',
    'uses'=>'PageController@adminAddProduct'
]);

Route::post('add',[
    'as'=>'add',
    'uses'=>'PageController@add'
    ]);

Route::post('productLineChart',[
    'as'=>'productLineChart',
    'uses'=>'PageController@productLineChart'
]);

Route::post('editAdminAccount',[
    'as'=>'editAdminAccount',
    'uses'=>'PageController@editAdminAccount'
]);

Route::post('editUserAccount',[
    'as'=>'editUserAccount',
    'uses'=>'PageController@editUserAccount'
]);

Route::get('getNextAdminID',[
    'as'=>'getNextAdminID',
    'uses'=>'PageController@NextIDAdmin'
]);

Route::post('insertAdminAccount',[
    'as'=>'insertAdminAccount',
    'uses'=>'PageController@insertAdminAccount'
]);

Route::post('insertUserAccount',[
    'as'=>'insertUserAccount',
    'uses'=>'PageController@insertUserAccount'
]);

Route::get('/all',[
    'as'=>'all',
function (){
    if(!(Session::has('admin'))){
        return "";
    }
    $listProduct = DB::select('SELECT * FROM `tbl_sanpham` ');
    $listqty= array();

    foreach ($listProduct as $product){
        $total=0;
        $arr = array();
        $bill = Bill_Product::where('MaMatHang','=',$product->IDSanPham)->get();
        if(count($bill)>0){
            foreach ($bill as $b){
                $total+=$b->SoLuong;
            }
        }
        array_push($listqty,$total);
    }

    for ($i=0;$i<count($listProduct);$i++){
        $chart = new Chart();
        $chart->maSanPham=$listProduct[$i]->IDSanPham;
        $chart->tenSanPham=$listProduct[$i]->TenSanPham;
        $chart->soLuongBanDuoc=$listqty[$i];
        array_push($arr,$chart);
    }

    $a=json_encode($arr);
    return $a;
}]);
Route::get('/jsonAccountAdmin/',[
    'as'=>'jsonAccountAdmin'
,function (){
    if(!(Session::has('admin'))){
        return "";
    }
    $listAdmin = DB::select('SELECT * FROM `tbl_admin` ');
    $a=json_encode($listAdmin);
    return $a;
}]);

Route::get('/jsonAccountUser/',[
    'as'=>'jsonAccountUser'
    ,function (){
    if(!(Session::has('admin'))){
        return "";
    }
    $listAdmin = DB::select('SELECT * FROM `tbl_khachhang` ');




    $a=json_encode($listAdmin);
    return $a;
}]);

Route::get('/json/{year}',[
    'as'=>'json'
    ,function (Request $request){
    if(!(Session::has('admin'))){
        return "";
    }
    $listProduct = DB::select('SELECT * FROM `tbl_sanpham` ');
    $listqty= array();

    foreach ($listProduct as $product){
        $total=0;
        $arr = array();
        $bill = DB::select("SELECT tbl_donhang_sanpham.SoLuong FROM `tbl_donhang_sanpham`,`tbl_donhang` WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang AND 
                            YEAR(tbl_donhang.NgayTao) = '$request->year' AND tbl_donhang_sanpham.MaMatHang='$product->IDSanPham'");
        if(count($bill)>0){
            foreach ($bill as $b){
                $total+=$b->SoLuong;
            }
        }
        array_push($listqty,$total);
    }

    for ($i=0;$i<count($listProduct);$i++){
        $chart = new Chart();
        $chart->maSanPham=$listProduct[$i]->IDSanPham;
        $chart->tenSanPham=$listProduct[$i]->TenSanPham;
        $chart->soLuongBanDuoc=$listqty[$i];
        array_push($arr,$chart);
    }

    $a=json_encode($arr);
    return $a;
}]);

Route::get('json2/{startDate}/{endDate}',[
    'as'=>'json2',
function (Request $request){
    if(!(Session::has('admin'))){
        return "";
    }
    $listProduct = DB::select('SELECT * FROM `tbl_sanpham` ');
    $listqty= array();

    foreach ($listProduct as $product){
        $total=0;
        $arr = array();
        $bill = DB::select("SELECT tbl_donhang_sanpham.SoLuong FROM `tbl_donhang_sanpham`,`tbl_donhang` WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang AND 
                            tbl_donhang.NgayTao >= '$request->startDate' AND tbl_donhang.NgayTao<='$request->endDate' AND tbl_donhang_sanpham.MaMatHang='$product->IDSanPham'");
        if(count($bill)>0){
            foreach ($bill as $b){
                $total+=$b->SoLuong;
            }
        }
        array_push($listqty,$total);
    }

    for ($i=0;$i<count($listProduct);$i++){
        $chart = new Chart();
        $chart->maSanPham=$listProduct[$i]->IDSanPham;
        $chart->tenSanPham=$listProduct[$i]->TenSanPham;
        $chart->soLuongBanDuoc=$listqty[$i];
        array_push($arr,$chart);
    }

    $a=json_encode($arr);
    return $a;
}]);

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

Route::get('adminAccount',[
    'as'=>'adminAccount',
    'uses'=>'PageController@adminAccount'
]);

Route::get('userAccount',[
    'as'=>'userAccount',
    'uses'=>'PageController@userAccount'
]);
