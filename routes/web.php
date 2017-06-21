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
use App\Accessories;
use App\Chart;
use App\Bill_Product;
use App\History;
use App\Product;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use App\ProductPerBill;

Route::get('/', 'pageController@index' );
Route::get('readAll',function (){
    $post = \App\tbl_anh::all();
    foreach ($post as $p){
        return $p->link;
    }
} );

Route::get('/test',function (){

    return '<a href="http://emwei.tk/">ok</a>';
});
Route::get('testImg/{id}',[
    'as'=>'testImg',
    function(Request $request){
    $billProduct = Bill_Product::where('MaDonHang','=',$request->id)->get();
    $arr = array();
    foreach ($billProduct as $bp){
        $productPerBill = new ProductPerBill;
        $productPerBill->MaSanPham = $bp->MaMatHang;
        $productPerBill->SoLuong = $bp->SoLuong;
        $product  = Product::find($bp->MaMatHang);
        if($product){
            $productPerBill->TenSanPham = $product->TenSanPham;
            $productPerBill->LoaiSanPham = $product->LoaiSanPham;
            $productPerBill->AnhDaiDien = $product->AnhDaiDien;

        }else{
            $accessori = Accessories::find($bp->MaMatHang);
            $productPerBill->TenSanPham = $accessori->TenPhuKien;
            $productPerBill->LoaiSanPham = $accessori->LoaiPhuKien;
            $productPerBill->AnhDaiDien = $accessori->AnhDaiDien;
        }
        array_push($arr,$productPerBill);
    }
    return json_encode($arr);
    }
]);

Route::get('/',[
    'as'=>'trang-chu',
    'uses'=>'PageController@index'
]);

//Route::get('/',function (){
//    return view('welcome');
//});

Route::get('customerStatistic',[
    'as'=>'customerStatistic',
    'uses'=>'PageController@customerStatistic'
]);

Route::get('dang-nhap',[
    'as'=>'dang-nhap',
    'uses'=>'PageController@login'
]);

Route::get('user-Page',[
    'as'=>'userPage',
    'uses'=>'PageController@userPage'
]);

Route::post('post-login',[
    'as'=>'post-login',
    'uses'=>'PageController@postLogin'
]);

Route::get('dang-ky',[
    'as'=>'dang-ky',
    'uses'=>'PageController@signUp'
]);

Route::get('discount',[
    'as'=>'discount',
    'uses'=>'PageController@discount'
]);

Route::get('search/{key}',[
    'as'=>'search',
    'uses'=>'PageController@search'
]);

Route::get('construction',[
    'as'=>'construction',
    'uses'=>'PageController@construction'
]);

Route::get('verify',[
    'as'=>'verify',
    'uses'=>'PageController@verify'
]);

Route::post('updateDisCountProduct',[
    'as'=>'updateDisCountProduct',
    'uses'=>'PageController@updateDisCountProduct'
]);

Route::post('post-signup',[
    'as'=>'post-signup',
    'uses'=>'PageController@postSignUp'
]);

Route::post('post-edit',[
    'as'=>'post-edit',
    'uses'=>'PageController@postEdit'
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

Route::get('list-product/{type}/{manufacturer}',[
    'as'=>'listProduct',
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

Route::get('all-Accessories',[
    'as'=>'adminAllAccessories',
    'uses'=>'PageController@adminAllAccessories'
]);

Route::get('bills',[
    'as'=>'bills',
    'uses'=>'PageController@bills'
]);



Route::get('check-bill/{id}',[
    'as'=>'check-bill',
    'uses'=>'PageController@checkBill'
]);

Route::get('done-bill/{id}',[
    'as'=>'done-bill',
    'uses'=>'PageController@doneBill'
]);

Route::get('detail-bill/{id}',[
    'as'=>'detail-bill',
    'uses'=>'PageController@detailBill'
]);

Route::get('remove-bill/{id}',[
    'as'=>'remove-bill',
    'uses'=>'PageController@removeBill'
]);

Route::post('edit-bill',[
    'as'=>'edit-bill',
    'uses'=>'PageController@postEditBill'
]);

Route::post('updateStatusBill',[
    'as'=>'updateStatusBill',
    'uses'=>'PageController@updateStatusBill'
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

Route::get('add-accessory',[
    'as'=>'adminAddAccessory',
    'uses'=>'PageController@adminAddAccessory'
]);

Route::post('addNewProduct',[
    'as'=>'addNewProduct',
    'uses'=>'PageController@addNewProduct'
    ]);

Route::post('addNewAccessory',[
    'as'=>'addNewAccessory',
    'uses'=>'PageController@addNewAccessory'
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

Route::post('updateStatusProduct',[
    'as'=>'updateStatusProduct',
    'uses'=>'PageController@updateStatusProduct'
]);

Route::post('updateStatusAccessory',[
    'as'=>'updateStatusAccessory',
    'uses'=>'PageController@updateStatusAccessory'
]);

Route::post('getProductBill',[
    'as'=>'getProductBill',
    'uses'=>'PageController@getProductBill'
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

Route::get('/allProductJson/',[
    'as'=>'allProductJson'
    ,function (){
        if(!(Session::has('admin'))){
            return "";
        }
        $listProduct = DB::select('SELECT * FROM `tbl_sanpham` ');
        $a=json_encode($listProduct);
        return $a;
    }]);

Route::get('/CustomerBill/',[
    'as'=>'CustomerBill'
    ,function (){
        if(!(Session::has('userName'))){
            return "";
        }
        $bills = History::where('EmailKhachHang','=',Session::get('userName')->Email)->get();
        $a=json_encode($bills);
        return $a;
    }]);

Route::get('/allAccessoriesJson/',[
    'as'=>'allAccessoriesJson'
    ,function (){
        if(!(Session::has('admin'))){
            return "";
        }
        $listProduct = DB::select('SELECT tbl_phukien.IDPhuKien,tbl_phukien.TenPhuKien,tbl_phukien.Gia,tbl_phukien.TinhTrang,tbl_sanpham.TenSanPham FROM `tbl_phukien`,tbl_sanpham WHERE tbl_sanpham.IDSanPham=tbl_phukien.MaSanPham');
        $a=json_encode($listProduct);
        return $a;
    }]);

Route::get('jsonBill',[
    'as'=>'jsonBill'
    ,function (){
        if(!(Session::has('admin'))){
            return "";
        }
        $listBill = DB::select('SELECT * FROM `tbl_donhang` ORDER by NgayTao DESC');
        $a=json_encode($listBill);
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

Route::get('edit-accessory/{id}',[
    'as'=>'edit-accessory',
    'uses'=>'PageController@getEditAccessory'
]);

Route::get('edit-product/{id}',[
    'as'=>'edit-product',
    'uses'=>'PageController@getEditProduct'
]);

Route::post('edit',[
    'as'=>'edit',
    'uses'=>'PageController@postEditProduct'
]);

Route::post('editAccessory',[
    'as'=>'editAccessory',
    'uses'=>'PageController@postEditAccessory'
]);


Route::get('delete-product/{id}',[
    'as'=>'delete-product',
    'uses'=>'PageController@getDeleteProduct'
]);

Route::get('delete-accessory/{id}',[
    'as'=>'delete-accessory',
    'uses'=>'PageController@getDeleteAccessory'
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
