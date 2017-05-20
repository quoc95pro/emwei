<?php
/**
 * Created by PhpStorm.
 * User: quoc95
 * Date: 5/2/2017
 * Time: 3:19 PM
 */

namespace App\Http\Controllers;
use App\Admin;
use App\Bill_Product;
use App\Customer;
use App\History;
use  App\Product;
use App\Photo;
use App\Description;
use function array_push;
use function count;
use function date;
use function e;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ProductType;
use Mockery\Exception;
use mysqli_sql_exception;
use function redirect;
use function session;
use Gloudemans\Shoppingcart\Facades\Cart;
use function view;

class pageController extends Controller
{
    public function index(){
        $newProduct = DB::select('SELECT * FROM `tbl_sanpham` WHERE TinhTrang!="Đã xóa" ORDER BY IDSanPham DESC LIMIT 6');
        // $newProduct=Product::orderBy('IDSanPham','DESC')->take(5)->get();

        $slide = DB::select('SELECT * FROM `tbl_sanpham` ORDER BY IDSanPham DESC LIMIT 3');
        // $slide=Product::take(3) ->get();
        $left=DB::select('SELECT HangSanXuat,COUNT(*) AS Count FROM `tbl_sanpham` GROUP BY HangSanXuat');
        $tabTitle=DB::select('SELECT LoaiPhuKien from `tbl_phukien` GROUP BY LoaiPhukien');
        $tabContent=DB::select('SELECT * FROM `tbl_anhphukien`,`tbl_phukien` WHERE tbl_anhphukien.MaSanPham=tbl_phukien.IDPhuKien ORDER BY tbl_phukien.IDPhuKien DESC LIMIT 5');
        return view('page.index')
            ->with(['newProducts' => $newProduct])
            ->with(['left' => $left])
            ->with(['tabTitle'=>$tabTitle])
            ->with(['slide' => $slide])
            ->with(['tabContent'=>$tabContent]);
    }

    public function postLoginAdmin(Request $req){
        $admin = Admin::where([
            ['IdAdmin','=',$req->idAdmin],
            ['MatKhau','=',$req->passWord]
        ])->first();

        if($admin){
            session(['admin' => $admin]);
            if($req->remember) {
                setcookie('adminID', $req->idAdmin, time() + (86400 * 10), "/"); // 86400 = 1 day
                setcookie('adminPass', $req->passWord, time() + (86400 * 10), "/"); // 86400 = 1 day
            }else{
                setcookie('adminID', null, -1, '/');
                setcookie('adminPass', null, -1, '/');
            }
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Sai Email Hoặc Mật Khẩu']);
        }

        return redirect()->route('admin-index');
    }

    public function logOutAdmin(Request $req){
        $req->session()->remove('admin');

        return redirect()->route('login-admin');
    }




    public function login(){
        return \view('page.login');
    }

    public function postLogin(Request $req){
        $this->validate($req,
            [
                'mail'=>'required|email',
                'pass'=>'required|min:6|max:20'
            ],
            [
                'mail.required'=>'Vui lòng nhập email',
                'mail.email'=>'Không đúng định dạng email',
                'pass.required'=>'Vui lòng nhập mật khẩu',
                'pass.min'=>'Mật khẩu ít nhất 6 kí tự',
            ]);


        $user = Customer::where([
            ['Email','=',$req->mail],
            ['MatKhau','=',$req->pass]
        ])->first();

        if($user){
            session(['userName' => $user]);
            if($req->save) {
                setcookie('mail', $req->mail, time() + (86400 * 10), "/"); // 86400 = 1 day
                setcookie('pass', $req->pass, time() + (86400 * 10), "/"); // 86400 = 1 day
            }else{
                setcookie('mail', null, -1, '/');
                setcookie('pass', null, -1, '/');
            }
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Sai Email Hoặc Mật Khẩu']);
        }

        return redirect()->route('trang-chu');
    }


    public function logout(Request $req){
             Cart::destroy();
            $req->session()->remove('userName');

        return redirect()->route('trang-chu');
    }

    public function signUp(){
        return \view('page.signup');
    }
    public function postSignUp(Request $req){
        $this->validate($req,
            [
                'mail'=>'required|email|unique:tbl_khachhang,Email',
                'pass'=>'required|min:6|max:20',
                'rePass'=>'required|same:pass',
                'name'=>'required|min:5|max:100',
                'phone'=>'min:10|max:11'
            ],
            [
                'mail.required'=>'Vui lòng nhập email',
                'mail.unique'=>'Email đã tồn tại',
                'mail.email'=>'Không đúng định dạng email',
                'pass.required'=>'Vui lòng nhập mật khẩu',
                'rePass.same'=>'Mật khẩu không giống nhau',
                'pass.min'=>'Mật khẩu ít nhất 6 kí tự',
                'name.min'=>'Độ dài tên không hợp lệ',
                'phone.min'=>'Số điện thoại có độ dài không hợp lệ',
                'phone.max'=>'Số điện thoại có độ dài không hợp lệ'
        ]);
                $newUser = new Customer();
                $newUser->TenKhachHang=$req->name;
                $newUser->Email=$req->mail;
                $newUser->MatKhau=$req->pass;
                $newUser->NamSinh=$req->dob;
                $newUser->GioiTinh=$req->sex;
                $newUser->SoDienThoai=$req->phone;
                $newUser->DiaChi=$req->add;
                $newUser->NgayTao=date('Y-m-d');
                $newUser->save();
        return $this->index();
    }



    public function contactUs(){
        return \view('page.contact-us');
    }

    public function checkout(){

        return \view('page.checkout')
            ->with(['listProduct'=>Cart::content()]);
    }

    public function editAdminAccount(Request $request){
        $mess='';
//        $type=array(['Administrator','Staff']);
        $this->validate($request,
            [
                'name'=>'required',
                'dob'=>'date_format:"Y-m-d"',
                'accountType'=>'required',
                'status'=>'required'
            ],
            [

                'name.required'=>'Vui lòng nhập tên',
                'dob.date_format'=>'Ngày tháng năm không đúng format',
                'accountType.required'=>'Vui lòng Nhập Loại Tài Khoản',
                'status.required'=>'Vui lòng Nhập Trạng Thái'
            ]);
        try{
            DB::update('UPDATE tbl_admin SET TenAdmin=?,NamSinh=?,Loai=?,TrangThai=? WHERE IDAdmin=?', [$request->name, $request->dob,$request->accountType,$request->status,$request->id]);
            $mess = 'Sửa Thành Công';
        }catch (mysqli_sql_exception $e){
            $mess = 'Lỗi : '.$e->getMessage();
        }

        return $mess;
    }

    public function editUserAccount(Request $request){
        $mess='Lỗi';
//        $type=array(['Administrator','Staff']);
        $this->validate($request,
            [
                'name'=>'required',
                'dob'=>'date_format:"Y-m-d"',
                'sex'=>'required',
                'phone'=>'required|numeric|min:9',
            ],
            [
                'name.required'=>'Vui lòng nhập tên',
                'dob.date_format'=>'Ngày tháng năm không đúng format',
                'sex.required'=>'Vui lòng nhập giới tính',
                'phone.required'=>'Vui lòng nhập số điện thoại',
                'phone.numeric'=>'Số điện thoại không hợp lệ',
            ]);

            if(DB::update('UPDATE tbl_khachhang SET TenKhachHang=?,NamSinh=?,GioiTinh=?,SoDienThoai=?,DiaChi=?,LoaiTaiKhoan=?,TrangThai=? WHERE Email=?',
                [$request->name,$request->dob,$request->sex,$request->phone,$request->add,$request->type,$request->status,$request->email]))
            $mess = 'Sửa Thành Công';
        return $mess;
    }

    public function insertUserAccount(Request $request)
    {
        $mess = '';
        $this->validate($request,
            [
                'email'=>'required|email|unique:tbl_khachhang,Email',
                'name'=>'min:2|max:50',
                'pass'=>'required|min:6|max:50',
                'repass'=>'same:pass',
                'dob'=>'date_format:"Y-m-d"',
                'phone'=>'min:9|max:11'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.unique'=>'Email đã tồn tại',
                'email.email'=>'Không đúng định dạng email',
                'dob.date_format'=>'Ngày tháng năm không đúng format',
                'name.min'=>'Tên có độ dài không hợp lệ(quá ngắn)',
                'name.max'=>'Tên có độ dài không hợp lệ(quá dài)',
                'pass.min'=>'Mật Khẩu có độ dài không hợp lệ(quá ngắn)',
                'pass.required'=>'Mật Khẩu không được để trống',
                'pass.max'=>'Mật Khẩu có độ dài không hợp lệ(quá dài)',
                'repass.same'=>'Mật Khẩu không trùng khớp',
                'phone.min'=>'Số điện thoại có độ dài không hợp lệ',
                'phone.max'=>'Số điện thoại có độ dài không hợp lệ'
            ]);

        try{
            $newUser = new Customer();
            $newUser->TenKhachHang=$request->name;
            $newUser->Email=$request->email;
            $newUser->MatKhau=$request->pass;
            $newUser->NamSinh=$request->dob;
            $newUser->GioiTinh=$request->sex;
            $newUser->SoDienThoai=$request->phone;
            $newUser->DiaChi=$request->add;
            $newUser->LoaiTaiKhoan=$request->accountType;
            $newUser->TrangThai=$request->status;
            $newUser->save();
            $mess = 'Thêm Thành Công';
        }catch (mysqli_sql_exception $e){
            $mess = 'Lỗi : '.$e->getMessage();
        }

        return $mess;

    }

    public function insertAdminAccount(Request $request)
    {
        $mess = '';
        $this->validate($request,
            [
                'name'=>'min:2|max:50',
                'pass'=>'required|min:6|max:50',
                'repass'=>'same:pass',
                'dob'=>'date_format:"Y-m-d"'
            ],
            [
                'dob.date_format'=>'Ngày tháng năm không đúng format',
                'name.min'=>'Tên có độ dài không hợp lệ(quá ngắn)',
                'name.max'=>'Tên có độ dài không hợp lệ(quá dài)',
                'pass.min'=>'Mật Khẩu có độ dài không hợp lệ(quá ngắn)',
                'pass.required'=>'Mật Khẩu không được để trống',
                'pass.max'=>'Mật Khẩu có độ dài không hợp lệ(quá dài)',
                'repass.same'=>'Mật Khẩu không trùng khớp',
            ]);

        try{
            $admin = new Admin();
            $admin->IDAdmin = $request->id;
            $admin->TenAdmin = $request->name;
            $admin->MatKhau = $request->pass;
            $admin->NamSinh = $request->dob;
            $admin->Loai = $request->accountType;
            $admin->TrangThai=$request->status;
            $admin->save();
            $mess = 'Thêm Thành Công';
        }catch (mysqli_sql_exception $e){
            $mess = 'Lỗi : '.$e->getMessage();
        }

        return $mess;

    }


    public function GetLastIDAdmin()
    {
        $sql = DB::select('SELECT IDAdmin FROM tbl_admin ORDER by IDAdmin DESC LIMIT 1');
        foreach ($sql as $a)
        {
            return $a->IDAdmin;
        }


    }

    public function NextIDAdmin()
    {
        $prefixID="Admin";
        if($this->GetLastIDAdmin()=="")
        {
            return $prefixID+"001";
        }
        $nextID = substr($this->GetLastIDAdmin(),5) +1;
        $lengthNumerID = strlen($this->GetLastIDAdmin())- strlen($prefixID);
        $zeroNumber = "";
        for ($i = 1; $i <= $lengthNumerID; $i++)
        {
            if ($nextID < pow(10, $i))
            {
                for ($j = 1; $j <= $lengthNumerID - $i; $j++)
                {
                    $zeroNumber=$zeroNumber."0";
                }
                return $prefixID.$zeroNumber.$nextID;
            }
        }
        return $prefixID.$nextID;

    }

    public function postCheckOut(Request $request){
        $userName = $request->userName;
        $userMail = $request->userMail;
        $userPhone = $request->userPhone;
        $userAddress = $request->userAddress;
        $ghiChu = 'Thanh Toán Trực Tiếp';
        $tongGia = 0;
        foreach (Cart::content() as $item){
            $tongGia+=($item->price*$item->qty);
        }
        if($request->httt=='giaohang'){
            $nameUser = $request->nameUser;
            $mailUser = $request->mailUser;
            $phoneUser = $request->phoneUser;
            $addressUser = $request->addressUser;
            $ghiChu = 'Giao Hàng Đến Địa Chỉ :'.$addressUser.' Người Nhận : '.$nameUser.' Email : '.$mailUser.' Số Điện Thoại : '.$phoneUser;

        }
        $maDonHang = $this->NextIDDonHang();
        $donHang = new History();
        $donHang->MaDonHang=$maDonHang;
        $donHang->EmailKhachHang=$userMail;
        $donHang->TenKhachHang=$userName;
        $donHang->SoDienThoai=$userPhone;
        $donHang->DiaChi=$userAddress;
        $donHang->GhiChu=$ghiChu;
        $donHang->Gia=$tongGia;
        $donHang->NgayTao=date("Y-m-d");
        $donHang->TinhTrang='Mới';
        $donHang->save();
        foreach (Cart::content() as $item){
            $bill_product = new Bill_Product();
            $bill_product->MaDonHang=$maDonHang;
            $bill_product->MaMatHang=$item->id;
            $bill_product->SoLuong=$item->qty;
            $bill_product->save();
        }
        return redirect()->route('trang-chu');
    }

    public function GetLastIdDonHang()
    {
        $sql = DB::select('SELECT MaDonHang FROM tbl_donhang ORDER by MaDonHang DESC LIMIT 1');
        foreach ($sql as $a)
        {
            return $a->MaDonHang;
        }


    }

    public function NextIDDonHang()
    {
        $prefixID="DH";
        if($this->GetLastIDDonHang()=="")
        {
            return $prefixID+"001";
        }
        $nextID = substr($this->GetLastIDDonHang(),2) +1;
        $lengthNumerID = strlen($this->GetLastIDDonHang())- strlen($prefixID);
        $zeroNumber = "";
        for ($i = 1; $i <= $lengthNumerID; $i++)
        {
            if ($nextID < pow(10, $i))
            {
                for ($j = 1; $j <= $lengthNumerID - $i; $j++)
                {
                    $zeroNumber=$zeroNumber."0";
                }
                return $prefixID.$zeroNumber.$nextID;
            }
        }
        return $prefixID.$nextID;

    }

    public function cart(){
        return view('page.cart')
            ->with(['a'=>Cart::count()])
            ->with(['listProduct'=>Cart::content()]);
    }

    public function blog(){
        return \view('page.blog');
    }

    public function blogSingle(){
        return \view('page.blog-single');
    }

    public function error404(){
        return \view('page.404');
    }

    public function getDetail( Request $req){
        $product = DB::select("SELECT * FROM `tbl_sanpham` WHERE  IDSanPham='$req->id'");
        $image = DB::select("SELECT * FROM `tbl_anh` WHERE link LIKE '%$req->id%'");
        $a = '';
        foreach ($product as $p){
            $a = $p->LoaiSanPham;
        }
        $relateProduct = DB::select("SELECT * FROM `tbl_sanpham` WHERE  LoaiSanPham='$a' ORDER BY IDSanPham DESC  limit 6");
        return \view('page.product-details')
            ->with(['product'=>$product])
            ->with(['relateProduct'=>$relateProduct])
            ->with(['listImage'=>$image]);
    }

    public function shop(){
        return \view('page.shop');
    }

    public function addCart(Request $req){
        $product = Product::where('IDSanPham','=',$req->id)->first();
        Cart::add($product->IDSanPham, $product->TenSanPham, 1, $product->Gia, ['img' => $product->AnhDaiDien]);

        return redirect()->route('cart');

    }

    public function cart_update_qty(Request $req){
        if($req->ajax()){
            $rowId = $req->id;
            $qty = $req->number;
            Cart::update($rowId, ['qty' => $qty]);
            $result = 0;
            foreach (Cart::content() as $item){
                $result+=($item->price*$item->qty);
            }

            echo $result;
        }
    }

    public function cart_delete(Request $req){
        if($req->ajax()){
            $rowId = $req->id;
            Cart::remove($rowId);
            $result = 0;
            foreach (Cart::content() as $item){
                $result+=($item->price*$item->qty);
            }

            echo $result;
        }
    }

    public function listProduct(Request $req){

        $listProduct = Product::where('LoaiSanPham','=',$req->type)
            ->where('TinhTrang','!=','Đã xóa')->paginate(9);
        return \view('page.shop')
            ->with(['listProduct'=>$listProduct])

            ;
    }
    public function admin(){
        $newOrder = DB::select('SELECT * from tbl_donhang WHERE NgayTao=?',[date('Y-m-d')]);
        $newUser =  DB::select('SELECT * from tbl_khachhang WHERE NgayTao=?',[date('Y-m-d')]);
        $arrTotal = array();
        for ($i=1;$i<13;$i++){
            $total = 0;
            $curYear = date("Y");
            $monthTotal = DB::select("SELECT tbl_donhang_sanpham.SoLuong FROM `tbl_donhang_sanpham`,`tbl_donhang`
 WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang AND MONTH(tbl_donhang.NgayTao) = '$i' AND YEAR(tbl_donhang.NgayTao) = '$curYear'");
            if(count($monthTotal)>0){
                foreach ($monthTotal as $item){
                    $total+=$item->SoLuong;
                }
            }
            array_push($arrTotal,$total);
        }

        $arrBill = array();
        for ($i=1;$i<13;$i++){

            $curYear = date("Y");
            $monthTotal = DB::select("SELECT * FROM `tbl_donhang` WHERE  MONTH(NgayTao) = '$i' AND YEAR(NgayTao) = '$curYear'");
            array_push($arrBill,count($monthTotal));
        }
        return \view('admin.index')
            ->with(['countNewOrder'=>count($newOrder)])
            ->with(['countNewUser'=>count($newUser)])
            ->with(['countProduct'=>$arrTotal])
            ->with(['countBill'=>$arrBill]);

    }

    public function widgets(){
        return \view('admin.widgets');

    }

    public function chart(){
        return \view('admin.chart');

    }

    public function charts(){
        $listProduct = DB::select('SELECT * FROM `tbl_sanpham` ');
        $minDate=DB::select('SELECT Min(NgayTao) AS NgayTao FROM tbl_donhang');
        $maxDate=DB::select('SELECT Max(NgayTao) AS NgayTao FROM tbl_donhang');
        $year = DB::select('SELECT YEAR(NgayTao) AS Nam FROM tbl_donhang GROUP by YEAR(NgayTao)');
        $arrTotal = array();
        for ($i=1;$i<13;$i++){
            $total = 0;
            $curYear = date("Y");
            $monthTotal = DB::select("SELECT tbl_donhang_sanpham.SoLuong FROM `tbl_donhang_sanpham`,`tbl_donhang`
 WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang AND MONTH(tbl_donhang.NgayTao) = '$i' AND YEAR(tbl_donhang.NgayTao) = '$curYear'");
            if(count($monthTotal)>0){
                foreach ($monthTotal as $item){
                    $total+=$item->SoLuong;
                }
            }
            array_push($arrTotal,$total);
        }

        $listqty= array();

        foreach ($listProduct as $product){
            $total=0;
            $bill = Bill_Product::where('MaMatHang','=',$product->IDSanPham)->get();
            if(count($bill)>0){
                foreach ($bill as $b){
                    $total+=$b->SoLuong;
                }
            }
            array_push($listqty,$total);

        }
        return \view('admin.charts')
            ->with(['listProduct'=>$listProduct])
            ->with(['qty'=>$listqty])
            ->with(['minDate'=>$minDate])
            ->with(['maxDate'=>$maxDate])
            ->with(['month'=>$arrTotal])
            ->with(['year'=>$year]);


    }


    public function productLineChart(Request $request){
        $arr= array();
        for ($i=1;$i<13;$i++){
            $total = 0;
            $monthTotal = DB::select("SELECT tbl_donhang_sanpham.SoLuong FROM `tbl_donhang_sanpham`,`tbl_donhang`WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang AND
 MONTH(tbl_donhang.NgayTao) = '$i' AND Year(tbl_donhang.NgayTao)='$request->year' ");
            if(count($monthTotal)>0){
                foreach ($monthTotal as $item){
                    $total+=$item->SoLuong;
                }
            }
            array_push($arr,$total);
        }




        $arrTotal = array();
        for ($i=1;$i<13;$i++){
            $total = 0;
            $monthTotal = DB::select("SELECT tbl_donhang_sanpham.SoLuong FROM `tbl_donhang_sanpham`,`tbl_donhang`
 WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang AND MONTH(tbl_donhang.NgayTao) = '$i'  AND tbl_donhang_sanpham.MaMatHang='$request->id' AND Year(tbl_donhang.NgayTao)='$request->year' ");
            if(count($monthTotal)>0){
                foreach ($monthTotal as $item){
                    $total+=$item->SoLuong;
                }
            }
            array_push($arrTotal,$total);
        }

        return [$arrTotal,$arr];


    }

    public function tables(){
        $listProduct = DB::select('SELECT * FROM `tbl_anh`,`tbl_sanpham` WHERE tbl_anh.MaSanPham=tbl_sanpham.IDSanPham');
        return \view('admin.tables')
            ->with(['listProduct'=>$listProduct]);

    }

    public function forms(){
        return \view('admin.forms');

    }

    public function panels(){
        return \view('admin.panels');

    }

    public function icons(){
        return \view('admin.icons');

    }

    public function loginAdmin(){
        return \view('admin.login
        ');

    }

    public function adminAllProduct(){
        $listProduct = DB::select('SELECT * FROM tbl_sanpham');
        return \view('admin.Product')
            ->with(['listProduct'=>$listProduct]);

    }
    public function bills(){
        $listBill = DB::select('SELECT * FROM `tbl_donhang` ORDER by NgayTao DESC');
        return \view('admin.Bill')
            ->with(['listBill'=>$listBill]);

    }

    public function checkBill(Request $request){
        Cart::destroy();
        $billDetail = DB::select("SELECT * FROM tbl_donhang,tbl_donhang_sanpham WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang and tbl_donhang.MaDonHang='$request->id'");
        foreach ($billDetail as $bill){
            $product = DB::select("SELECT * FROM tbl_sanpham WHERE IDSanPham='$bill->MaMatHang'");
            Cart::add($product[0]->IDSanPham, $product[0]->TenSanPham, $bill->SoLuong, $product[0]->Gia, ['img' => $product[0]->AnhDaiDien]);
        }



        return \view('admin.BillDetail')
            ->with(['bill'=>$billDetail])
            ->with(['cart'=>Cart::content()]);

    }

    public function postEditBill(Request $request){
        $donHang = History::find($request->maDonHang);
        if($request->chkChinhSua){
            $donHang->TenKhachHang=$request->tenKhachHang;
            $donHang->EmailKhachHang=$request->mailKhachHang;
            $donHang->SoDienThoai=$request->soDienThoai;
            $donHang->DiaChi=$request->diaChi;

            foreach (Cart::content() as $item){
                DB::update('UPDATE tbl_donhang_sanpham SET SoLuong=? WHERE MaDonHang=? AND MaMatHang=?', [$item->qty, $request->maDonHang,$item->id]);
            }
            $tongGia = 0;
            foreach (Cart::content() as $item){
                $tongGia+=($item->price*$item->qty);
            }
            $donHang->GhiChu=$request->ghiChu;
            $donHang->Gia=$tongGia;
            $donHang->TinhTrang="Đang Giao Hàng";
            $donHang->save();
        }else{
            $donHang->TinhTrang="Đang Giao Hàng";
            $donHang->save();
        }

        return redirect()->route('bills');
    }

    public function cart_update_qty_admin(Request $req){
        if($req->ajax()){
            $rowId = $req->id;
            $qty = $req->number;
            Cart::update($rowId, ['qty' => $qty]);
            $result = 0;
            foreach (Cart::content() as $item){
                $result+=($item->price*$item->qty);
            }

            echo $result;
        }
    }

    public function cart_delete_admin(Request $req){
        if($req->ajax()){
            $rowId = $req->id;
            Cart::remove($rowId);
            $result = 0;
            foreach (Cart::content() as $item){
                $result+=($item->price*$item->qty);
            }

            echo $result;
        }
    }

    public function adminAddProduct(){
        $listType=DB::select('select * from tbl_loaisanpham');
        $productTypes = DB::select('SELECT LoaiSanPham FROM `tbl_sanpham` GROUP BY LoaiSanPham');
        $companies = DB::select('SELECT HangSanXuat FROM `tbl_sanpham` GROUP BY HangSanXuat');
        $description = DB::select('SELECT * FROM `tbl_motasanpham`');

        return \view('admin.addproduct')
            ->with(['listType'=>$listType])
            ->with(['productTypes'=>$productTypes])
            ->with(['companies'=>$companies])
            ->with(['description'=>$description])
            ->with(['nextID'=>$this->NextID()]);

    }

    public function GetLastID()
    {
        $sql = DB::select('SELECT IDSanPham FROM tbl_sanpham ORDER by IDSanPham DESC LIMIT 1');
        foreach ($sql as $a)
        {
            return $a->IDSanPham;
        }


    }

    public function NextID()
    {
        $prefixID="SP";
        if($this->GetLastID()=="")
        {
            return $prefixID+"001";
        }
        $nextID = substr($this->GetLastID(),2) +1;
        $lengthNumerID = strlen($this->GetLastID())- strlen($prefixID);
        $zeroNumber = "";
        for ($i = 1; $i <= $lengthNumerID; $i++)
        {
            if ($nextID < pow(10, $i))
            {
                for ($j = 1; $j <= $lengthNumerID - $i; $j++)
                {
                    $zeroNumber=$zeroNumber."0";
                }
                return $prefixID.$zeroNumber.$nextID;
            }
        }
        return $prefixID.$nextID;

    }
    public function add(Request $req)
    {
        $this->validate($req,
            [
                'productName'=>'required'

            ],[
                'name.required'=>'error'
            ]
        );

        $product = new Product();
        $product->IDSanPham = $req->productID;
        $product->TenSanPham = $req->productName;

        if($req->companyCheckBox){
            $product->HangSanXuat = $req->companyInput;
        }else{
            $product->HangSanXuat = $req->productCompany;
        }


        $product->LoaiSanPham = $req->productType;
        $product->Gia = $req->productPrice;
        $product->SoLuong = $req->productQTY;
        $product->TinhTrang = $req->productStatus;
        $mota = Description::all();
        $stringMoTa='';
        foreach ($mota as $item){
            $tenMoTa=$item->TenMoTa;
            $stringMoTa=$stringMoTa.$item->MoTa.':'.$req->$tenMoTa.';';
        }
        $product->MoTa=rtrim($stringMoTa,";");
        if(isset($req->image)) {
            $product->AnhDaiDien= 'images/product/' . $req->productID.'_0.' . $req->image[0]->getClientOriginalExtension();
        }else{
            $product->AnhDaiDien = 'images/product/defaultProduct.png';

        }
        $product->save();

//         foreach ($req->image as $img)
//             $filename+= $img->store('photos');
        if(isset($req->image)) {
            $i=0;
            foreach ($req->image as $file) {
                $path = public_path() . '/images/product/';
                $file->move($path, $req->productID.'_'.$i. '.' . $file->getClientOriginalExtension());
                $photo = new Photo();
                $photo->MaSanPham = $req->productID;
                $photo->link = 'images/product/' . $req->productID.'_'.$i . '.' . $file->getClientOriginalExtension();
                $photo->save();
                $i++;
            }
        }

        return redirect()->route('adminAllProduct')->with('thanhcong','Thêm thành công');
    }

    public function getEditProduct(Request $req){
        $product = DB::select("SELECT * FROM `tbl_sanpham` WHERE IDSanPham='$req->id'");
        $productTypes = DB::select('SELECT LoaiSanPham FROM `tbl_sanpham` GROUP BY LoaiSanPham');
        $companies = DB::select('SELECT HangSanXuat FROM `tbl_sanpham` GROUP BY HangSanXuat');
        $description = DB::select('SELECT * FROM `tbl_motasanpham`');
        $image = DB::select("SELECT * FROM `tbl_anh` WHERE link LIKE '%$req->id%'");
        return \view('admin.edit')
            ->with(['product'=>$product])
            ->with(['productTypes'=>$productTypes])
            ->with(['companies'=>$companies])
            ->with(['description'=>$description])
            ->with(['image'=>$image]);



    }

    public function postEditProduct(Request $req)
    {
        $this->validate($req,
            [
                'productName'=>'required'

            ],[
                'name.required'=>'error'
            ]
        );

        $product = Product::find($req->productID);
        $product->TenSanPham = $req->productName;
        $product->HangSanXuat = $req->productCompany;
        $product->LoaiSanPham = $req->productType;
        $product->Gia = $req->productPrice;
        $product->SoLuong = $req->productQTY;
        $product->TinhTrang = $req->productStatus;
        $mota = Description::all();
        $stringMoTa='';
        foreach ($mota as $item){
            $tenMoTa=$item->TenMoTa;
            $stringMoTa=$stringMoTa.$item->MoTa.':'.$req->$tenMoTa.';';
        }

        $product->MoTa=rtrim($stringMoTa,";");
        $product->save();


        return redirect()->back()->with('thanhcong','Sửa thành công');
    }

    public function getDeleteProduct(Request $req){
        $product = Product::find($req->id);
        $product->TinhTrang = "Đã xóa";
        $product->save();
        return $this->adminAllProduct();

    }

    public function getAddProductType(){
        return \view('admin.addProductType');
    }

    public function postAddProductType(Request $req){

        $pt = new ProductType();
        $pt->TenLoaiSanPham = $req->productTypeName;
        $pt->save();

        $pt = DB::select('SELECT * FROM `tbl_loaisanpham` ORDER BY MaLoaiSanPham DESC limit 1');
        $a = new ProductType();
        foreach ($pt as $x){
            $a->MaLoaiSanPham=$x->MaLoaiSanPham;
        }
        $numberOfDescription = $req->numberOfDescription;
        if ($numberOfDescription>0){
            for ($i=0;$i<$numberOfDescription;$i++){
                $tenMoTa = 'mota'.$i;
                if(isset($req->$tenMoTa)){
                    $des = new Description();
                    $des->MoTa=$req->$tenMoTa;
                    $des->TenMoTa=$this->chuyenChuoi($req->$tenMoTa);
                    $des->LoaiSanPham=1;
                    $des->save();
                }
            }
        }





        return $this->adminAllProduct();
    }

    function chuyenChuoi($str) {
// In thường
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
// In đậm
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/( )/", '', $str);
// xóa khoảng trắng

        return $str; // Trả về chuỗi đã chuyển
    }

    function adminAccount(){
        return view('admin.adminAccount');
    }
    function userAccount(){
        return view('admin.userAccount');
    }

}