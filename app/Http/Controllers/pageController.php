<?php
/**
 * Created by PhpStorm.
 * User: quoc95
 * Date: 5/2/2017
 * Time: 3:19 PM
 */

namespace App\Http\Controllers;
use App\Accessories;
use App\Admin;
use App\Bill_Product;
use App\Customer;
use App\History;
use App\PhotoAccesories;
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
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use mysqli_sql_exception;
use const null;
use PhpParser\Node\Stmt\Return_;
use function redirect;
use function round;
use function route;
use function session;
use Gloudemans\Shoppingcart\Facades\Cart;
use function substr;
use function unlink;
use function view;

class pageController extends Controller
{
    public function index(){
        $newProduct = DB::select('SELECT * FROM `tbl_sanpham` WHERE TinhTrang!="Đã xóa" ORDER BY IDSanPham DESC LIMIT 6');
        // $newProduct=Product::orderBy('IDSanPham','DESC')->take(5)->get();

        $slide = DB::select('SELECT * FROM `tbl_sanpham` ORDER BY IDSanPham DESC LIMIT 3');
        // $slide=Product::take(3) ->get();
        $tabTitle=DB::select('SELECT LoaiPhuKien from `tbl_phukien` GROUP BY LoaiPhukien');
        $tabContent= array();
        foreach ($tabTitle as $title){
           $content =  DB::select('SELECT * FROM `tbl_phukien` WHERE LoaiPhuKien =? ORDER BY tbl_phukien.IDPhuKien DESC LIMIT 3',[$title->LoaiPhuKien]);
           foreach ($content as $c){
               array_push($tabContent,$c);
           }
        }
        return view('page.index')
            ->with(['newProducts' => $newProduct])
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
        if((Session::has('userName'))){
            return redirect()->route('trang-chu');
        }
        return \view('page.login');
    }

    public function userPage(){
        if((Session::has('userName'))){
            $user = Customer::find(Session::get('userName')->Email);
            return view('page.userPage')
                ->with(['user'=>$user]);
        }
        return redirect()->route('trang-chu');
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
        if(!(Session::has('userName'))){
            return redirect()->route('trang-chu');
        }
             Cart::destroy();
            $req->session()->remove('userName');

        return redirect()->route('trang-chu');
    }

    public function signUp(){
        return \view('page.signup');
    }
    public function construction(){
        return \view('page.construction');
    }

    public function getProductBill(Request $request){

        return $request->id;
    }

    public function postEdit(Request $request){
        $this->validate($request,
            [
                'pass'=>'required|min:6|max:20',
                'rePass'=>'required|same:pass',
                'name'=>'required|min:5|max:100',
            ],
            [
                'pass.required'=>'Vui lòng nhập mật khẩu',
                'rePass.same'=>'Mật khẩu không giống nhau',
                'pass.min'=>'Mật khẩu ít nhất 6 kí tự',
                'name.min'=>'Độ dài tên không hợp lệ',
            ]);
        $user = Customer::find(Session::get('userName')->Email);
        $user->MatKhau = $request->pass;
        $user->TenKhachHang=$request->name;
        $user->GioiTinh=$request->sex;
        $user->NamSinh=$request->dob;
        $user->DiaChi = $request->add;
        $user->save();
        return redirect()->route('userPage');
    }

    public function postSignUp(Request $req){
        $this->validate($req,
            [
                'mail'=>'required|email|unique:tbl_khachhang,Email',
                'pass'=>'required|min:6|max:20',
                'rePass'=>'required|same:pass',
                'name'=>'required|min:5|max:100',
                'phone'=>'min:9|max:11|unique:tbl_khachhang,SoDienThoai',
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
                'phone.max'=>'Số điện thoại có độ dài không hợp lệ',
                'phone.unique'=>'Số điện thoại đã tồn tại',
        ]);
        if($req->mailgt!=''){
            $mailgt = Customer::find($req->mailgt);
            if(!$mailgt){
                return redirect()->back()->with(['flag'=>'danger','message'=>'Mail giới thiệu không tồn tại']);
            }
        }

//cấu hình thông tin do google cung cấp
$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
$secret_key  = '6LdmNSMUAAAAABFRIH5RxBlD8riTvxwHiSVBsgSV';

    $site_key_post    = $_POST['g-recaptcha-response'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $remoteip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $remoteip = $_SERVER['REMOTE_ADDR'];
    }
    $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
    $response = file_get_contents($api_url);
    $response = json_decode($response);
    if(!isset($response->success))
    {
        return redirect()->back()->with(['flag'=>'danger','message'=>'Sai Captcha']);
    }
    if(!$response->success == true)
    {
        return redirect()->back()->with(['flag'=>'danger','message'=>'Bạn chưa nhập Captcha']);
    }

                $newUser = new Customer();
                $newUser->TenKhachHang=$req->name;
                $newUser->Email=$req->mail;
                $newUser->MatKhau=$req->pass;
                $newUser->NamSinh=$req->dob;
                $newUser->GioiTinh=$req->sex;
                $newUser->SoDienThoai=$req->phone;
                $newUser->DiaChi=$req->add;
                $newUser->LoaiTaiKhoan='Đồng';
                $newUser->TrangThai='InActive';
                $newUser->EmailGioiThieu=$req->mailgt;
                $newUser->NgayTao=date('Y-m-d');
                $newUser->save();
        session(['userName' => $newUser]);
        return redirect()->route('verify');
    }

    public  function verify(){
        if(!(Session::has('userName'))){
            return redirect()->route('trang-chu');
        }
        if(Session::get('userName')->TrangThai!='InActive'){
            return redirect()->route('discount');
        }
        return view('page.verify');
    }

    public  function discount(){
        if(!(Session::has('userName'))){
            return redirect()->route('trang-chu');
        }
        if(Session::get('userName')->ChietKhau!=0){
            return redirect()->route('trang-chu');
        }
        if(Session::get('userName')->EmailGioiThieu!=''){
            $mailgt = Customer::find(Session::get('userName')->EmailGioiThieu);
            $mailgt->ChietKhau+=0.02;
            $mailgt->save();
        }
        return view('page.ChietKhau');

    }

    public  function updateDisCountProduct(Request $request){
        DB::update('UPDATE tbl_khachhang SET ChietKhau=? WHERE Email=?',[$request->discount,Session::get('userName')->Email]);
        Session::get('userName')->ChietKhau=$request->discount;

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

        $api_url     = 'https://www.google.com/recaptcha/api/siteverify';
        $secret_key  = '6LdmNSMUAAAAABFRIH5RxBlD8riTvxwHiSVBsgSV';

        $site_key_post    = $_POST['g-recaptcha-response'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $remoteip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $remoteip = $_SERVER['REMOTE_ADDR'];
        }
        $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
        $response = file_get_contents($api_url);
        $response = json_decode($response);
        if(!isset($response->success))
        {
            return redirect()->back()->with(['flag'=>'danger','message'=>'Sai Captcha']);
        }
        if(!$response->success == true)
        {
            return redirect()->back()->with(['flag'=>'danger','message'=>'Bạn chưa nhập Captcha']);
        }

        $userName = $request->userName;
        $userMail = $request->userMail;
        $userPhone = $request->userPhone;
        $userAddress = $request->userAddress;
        $ghiChu = 'Thanh Toán Trực Tiếp';
        $tongGia = 0;
        foreach (Cart::content() as $item){
            $tongGia+=($item->price*$item->qty);
        }
        $ck=0;
        if((Session::has('userName'))){
            $tongGia=$tongGia-round($tongGia/100*Session::get('userName')->ChietKhau/1000)*1000;
            $ck=Session::get('userName')->ChietKhau;
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
        $donHang->ChietKhau=$ck;
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
        if(substr($req->id,0,2)=="PK"){
            $accessory = DB::select("SELECT * FROM `tbl_phukien` WHERE  IDPhuKien='$req->id'");
            $image = DB::select("SELECT * FROM `tbl_anhphukien` WHERE link LIKE '%$req->id%'");
            $a = '';
            foreach ($accessory as $p){
                $a = $p->MaSanPham;
            }
            $product = Product::find($a);
            $relateProduct = DB::select("SELECT * FROM `tbl_phukien` WHERE  MaSanPham='$a' ORDER BY IDPhuKien DESC  limit 6");
            return \view('page.product-details')
                ->with(['product'=>$accessory])
                ->with(['relateProduct'=>$relateProduct])
                ->with(['listImage'=>$image])
                ->with(['mainProduct'=>$product]);
        }
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
        if(substr($req->id,0,2)=="PK"){
            $accessory = Accessories::find($req->id);
            Cart::add($req->id, $accessory->TenPhuKien, 1, $accessory->Gia, ['img' => $accessory->AnhDaiDien]);
        }else{
            $product = Product::where('IDSanPham','=',$req->id)->first();
            Cart::add($product->IDSanPham, $product->TenSanPham, 1, $product->Gia, ['img' => $product->AnhDaiDien]);
        }


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
        if($req->type=='PhuKien') {
            if($req->manufacturer=='all'){
                $accessory = Accessories::where('TinhTrang','!=','Đã xóa')
                    ->paginate(9);

                return \view('page.shop')
                    ->with(['type'=>'phukien'])
                    ->with(['listProduct'=>$accessory]);
            }
            $accessory = Accessories::where('TinhTrang','!=','Đã xóa')
                ->where('LoaiPhuKien','=',$req->manufacturer)
                ->paginate(9);

            return \view('page.shop')
                ->with(['listProduct'=>$accessory])
                ->with(['type'=>'phukien']);
        }
        if($req->manufacturer!='all'){
            $listProduct = Product::where('LoaiSanPham','=',$req->type)
                            ->where('HangSanXuat','=',$req->manufacturer)
                            ->where('TinhTrang','!=','Đã xóa')
                            ->paginate(9);

            return \view('page.shop')
                ->with(['listProduct'=>$listProduct]);
        }
        $listProduct = Product::where('LoaiSanPham','=',$req->type)
                                ->where('TinhTrang','!=','Đã xóa')
                                ->paginate(9);
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

    public function adminAllAccessories(){
        $listProduct = DB::select('SELECT * FROM tbl_phukien');
        return \view('admin.Accessories')
            ->with(['listProduct'=>$listProduct]);

    }
    public function bills(){
        return \view('admin.Bill');

    }

    public function checkBill(Request $request){
        Cart::destroy();
        $billDetailProduct = DB::select("SELECT * FROM tbl_donhang,tbl_donhang_sanpham WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang and tbl_donhang.MaDonHang='$request->id'");
        foreach ($billDetailProduct as $bill){
            $product = DB::select("SELECT * FROM tbl_sanpham WHERE IDSanPham='$bill->MaMatHang'");
            if($product){
                Cart::add($product[0]->IDSanPham, $product[0]->TenSanPham, $bill->SoLuong, $product[0]->Gia, ['img' => $product[0]->AnhDaiDien]);

            }
        }

        foreach ($billDetailProduct as $bill){
            $accessory = DB::select("SELECT * FROM tbl_PhuKien WHERE IDPhuKien='$bill->MaMatHang'");
            if($accessory){
                Cart::add($accessory[0]->IDPhuKien, $accessory[0]->TenPhuKien, $bill->SoLuong, $accessory[0]->Gia, ['img' => $accessory[0]->AnhDaiDien]);
            }
        }



        return \view('admin.BillDetail')
            ->with(['bill'=>$billDetailProduct])
            ->with(['cart'=>Cart::content()])
            ->with(['type'=>'check']);

    }

    public function updateStatusBill(Request $request){
        $donHang = History::find($request->id);
        if($donHang->TinhTrang!='Đã Giao Hàng') {
            $donHang->TinhTrang = $request->status;
            $donHang->save();
        }
    }

    public  function search(Request $request){

        $product = DB::select("SELECT * FROM `tbl_sanpham` WHERE  TenSanPham LIKE '%$request->key%'
                              OR LoaiSanPham LIKE '%$request->key%' OR HangSanXuat LIKE '%$request->key%' LIMIT 10");
        $result = '';
        if(count($product)>0) {
            for ($i = 0; $i < count($product); $i++) {
                $result .= "<a href=\"http://emwei.tk/detail-product/{$product[$i]->IDSanPham}\" style='color: red'><div style='height: 50px;margin-top: 5px'>
                                <div style=\"float: left\">
                                    <img style=\"width: 50px;height: 50px\" src=\"http://emwei.tk/{$product[$i]->AnhDaiDien}\">
                                </div>
                                <div style='margin-left: 60px;border-bottom: 1px solid brown'>
                                    <div><h6 class='compact2'>{$product[$i]->TenSanPham}</h6></div>
                                    <div><h6>{$product[$i]->Gia}</h6></div>
                                </div>
                            </div></a>";
            }
        }else{
            $accessory = DB::select("SELECT * FROM `tbl_phukien` WHERE  TenPhuKien LIKE '%$request->key%'
                              OR LoaiPhuKien LIKE '%$request->key%'");
            for ($i = 0; $i < count($accessory); $i++) {
                $result .= "<a href=\"http://emwei.tk/detail-product/{$accessory[$i]->IDPhuKien}\" style='color: red'> <div style='height: 50px;margin-top: 5px'>
                                <div style=\"float: left\">
                                    <img style=\"width: 50px;height: 50px\" src=\"http://emwei.tk/{$accessory[$i]->AnhDaiDien}\">
                                </div>
                                <div style='margin-left: 60px;border-bottom: 1px solid brown'>
                                    <div><h6 class='compact2'>{$accessory[$i]->TenPhuKien}</h6></div>
                                    <div><h6>{$accessory[$i]->Gia}</h6></div>
                                </div>
                            </div></a>";
            }
        }


        return $result;
    }

    public function doneBill(Request $request){
        $donHang = History::find($request->id);
        $donHang->TinhTrang = 'Đã Giao Hàng';
        $donHang->save();

        $billDetail = DB::select("SELECT * FROM tbl_donhang,tbl_donhang_sanpham WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang and tbl_donhang.MaDonHang='$request->id'");
        foreach ($billDetail as $bill){
            $product =  Product::find($bill->MaMatHang);
            if ($product){
                $product->SoLuong-=$bill->SoLuong;
                if($product->SoLuong==0){
                    $product->TinhTrang = 'Hết Hàng';
                }
                $product->save();
            }

            $accessory =  Accessories::find($bill->MaMatHang);
            if ($accessory){
                $accessory->SoLuong-=$bill->SoLuong;
                if($accessory->SoLuong==0){
                    $accessory->TinhTrang = 'Hết Hàng';
                }
                $accessory->save();
            }
        }
        if(Customer::find($billDetail[0]->EmailKhachHang)){
            $mail='';
            foreach ($billDetail as $b)
                $mail=$b->EmailKhachHang;
            $billCustomer = DB::select("SELECT * FROM tbl_donhang WHERE EmailKhachHang='$mail' AND TinhTrang='Đã Giao Hàng'");

            $total = 0;
            foreach ($billCustomer as $bill){
                $total+=$bill->Gia;
            }

            $cus=Customer::find($billDetail[0]->EmailKhachHang);
            if($total>=10000000&&$cus->LoaiTaiKhoan!='Vàng'&&$cus->LoaiTaiKhoan!='Kim Cương'){
                $cus->LoaiTaiKhoan='Bạc';
                $cus->ChietKhau+=1;
            }
            if($total>=50000000&&$cus->LoaiTaiKhoan!='Kim Cương'){
                $cus->LoaiTaiKhoan='Vàng';
                $cus->ChietKhau+=2;
            }
            if($total>=100000000){
                $cus->LoaiTaiKhoan='Kim Cương';
                $cus->ChietKhau+=3;
            }
            $cus->save();
        }
        return redirect()->route('bills');

    }

    public function detailBill(Request $request){
        Cart::destroy();
        $billDetail = DB::select("SELECT * FROM tbl_donhang,tbl_donhang_sanpham WHERE tbl_donhang.MaDonHang=tbl_donhang_sanpham.MaDonHang and tbl_donhang.MaDonHang='$request->id'");
        foreach ($billDetail as $bill){
            $product = DB::select("SELECT * FROM tbl_sanpham WHERE IDSanPham='$bill->MaMatHang'");
            if($product){
                Cart::add($product[0]->IDSanPham, $product[0]->TenSanPham, $bill->SoLuong, $product[0]->Gia, ['img' => $product[0]->AnhDaiDien]);
            }
            else{
                $accessori = Accessories::find($bill->MaMatHang);
                Cart::add($accessori->IDPhuKien, $accessori->TenPhuKien, $bill->SoLuong, $accessori->Gia, ['img' => $accessori->AnhDaiDien]);
            }
        }



        return \view('admin.BillDetail')
            ->with(['bill'=>$billDetail])
            ->with(['cart'=>Cart::content()])
            ->with(['type'=>'detail']);

    }

    public function removeBill(Request $request){
        $donHang = History::find($request->id);
        $donHang->TinhTrang = 'Đã Hủy';
        $donHang->save();
        return redirect()->route('bills');

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
            if($request->ck>0){
                $donHang->Gia=$tongGia-round($tongGia/100*$request->ck/1000)*1000;
            }
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

    public function adminAddAccessory(){
        $accessoryTypes = DB::select('SELECT LoaiPhuKien FROM `tbl_phukien` GROUP BY LoaiPhuKien');
        $product = DB::select('SELECT * FROM `tbl_sanpham`');
        return \view('admin.AddAccessory')
            ->with(['accessoryTypes'=>$accessoryTypes])
            ->with(['nextID'=>$this->NextIDAccessory()])
            ->with(['allProduct'=>$product]);
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

    public function GetLastIDAccessory()
    {
        $sql = DB::select('SELECT IDPhuKien FROM tbl_phukien ORDER by IDPhuKien DESC LIMIT 1');
        foreach ($sql as $a)
        {
            return $a->IDPhuKien;
        }


    }

    public function NextIDAccessory()
    {
        $prefixID="PK";
        if($this->GetLastIDAccessory()=="")
        {
            return $prefixID+"001";
        }
        $nextID = substr($this->GetLastIDAccessory(),2) +1;
        $lengthNumerID = strlen($this->GetLastIDAccessory())- strlen($prefixID);
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
    public function addNewProduct(Request $req)
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

    public function addNewAccessory(Request $req)
    {
        $accessory = new Accessories();
        $accessory->IDPhuKien = $req->accessoryID;
        $accessory->TenPhuKien = $req->accessoryName;

        if($req->typeCheckBox){
            $accessory->LoaiPhuKien = $req->typeInput;
        }else{
            $accessory->LoaiPhuKien = $req->accessoryType;
        }


        $accessory->MaSanPham = $req->productID;
        $accessory->Gia = $req->accessoryPrice;
        $accessory->SoLuong = $req->accessoryQTY;
        $accessory->TinhTrang = $req->accessoryStatus;
        $accessory->MoTa=$req->accessoryDescription;
        if(isset($req->image)) {
            $accessory->AnhDaiDien= 'images/accessory/' . $req->accessoryID.'_0.' . $req->image[0]->getClientOriginalExtension();
        }else{
            $accessory->AnhDaiDien = 'images/product/defaultProduct.png';

        }
        $accessory->save();
        if(isset($req->image)) {
            $i=0;
            foreach ($req->image as $file) {
                $path = public_path() . '/images/accessory/';
                $file->move($path, $req->accessoryID.'_'.$i. '.' . $file->getClientOriginalExtension());
                $photo = new PhotoAccesories();
                $photo->MaSanPham = $req->accessoryID;
                $photo->link = 'images/accessory/' . $req->accessoryID.'_'.$i . '.' . $file->getClientOriginalExtension();
                $photo->save();
                $i++;
            }
        }

        return redirect()->route('adminAllAccessories')->with('thanhcong','Thêm thành công');
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

    public function getEditAccessory(Request $req){
        $accessoryTypes = DB::select('SELECT LoaiPhuKien FROM `tbl_phukien` GROUP BY LoaiPhuKien');
        $product = DB::select('SELECT * FROM `tbl_sanpham`');
        $accessory = DB::select("SELECT * FROM `tbl_phukien` WHERE IDPhuKien='$req->id'");
        $image = DB::select("SELECT * FROM `tbl_anhphukien` WHERE link LIKE '%$req->id%'");
        return \view('admin.EditAccessory')
            ->with(['product'=>$product])
            ->with(['accessory'=>$accessory])
            ->with(['accessoryTypes'=>$accessoryTypes])
            ->with(['image'=>$image]);
    }

    public function postEditAccessory(Request $req)
    {


        $accessory = Accessories::find($req->accessoryID);
        $accessory->TenPhuKien = $req->accessoryName;
        if($req->typeCheckBox){
            $accessory->LoaiPhuKien = $req->typeInput;
        }else{
            $accessory->LoaiPhuKien = $req->accessoryType;
        }
        $accessory->Gia = $req->accessoryPrice;
        $accessory->SoLuong = $req->accessoryQTY;
        $accessory->TinhTrang = $req->accessoryStatus;


        if($req->imgDeleteID!=''){
            $imgDeleteID=rtrim($req->imgDeleteID,",");
            $x = preg_split("/,/", $imgDeleteID);
            $image = DB::select("SELECT * FROM `tbl_anhphukien` WHERE link LIKE '%$req->accessoryID%'");
            foreach ($x as $delete){
                DB::delete('DELETE FROM `tbl_anhphukien` WHERE IDAnh=?',[$image[$delete]->IDAnh]);
                unlink(public_path().'/'.$image[$delete]->link);
            }
        }

        $i=0;
        $newImage = DB::select("SELECT * FROM `tbl_anhphukien` WHERE link LIKE '%$req->accessoryID%'");
        foreach ($newImage as $img){
            $newLink = 'images/accessory/' . $req->accessoryID.'_'.$i . '.' .preg_split("/[.]/", $img->link)[1];
            DB::update('UPDATE `tbl_anh` SET `link`=? WHERE IDAnh=? ',[$newLink,$img->IDAnh]);
            rename(public_path().'/'.$img->link,$newLink);
            $i++;
        }

        if($i>0){
            $accessory->AnhDaiDien= 'images/accessory/' . $req->accessoryID.'_0.' .preg_split("/[.]/", $newImage[0]->link)[1];
        }elseif(isset($req->image)) {
            $accessory->AnhDaiDien= 'images/accessory/' . $req->accessoryID.'_0.' . $req->image[0]->getClientOriginalExtension();
        }else{
            $accessory->AnhDaiDien = 'images/product/defaultProduct.png';

        }





        $accessory->save();

        if(isset($req->image)) {
            foreach ($req->image as $file) {
                $path = public_path() . '/images/accessory/';
                $file->move($path, $req->accessoryID.'_'.$i. '.' . $file->getClientOriginalExtension());
                $photo = new PhotoAccesories();
                $photo->MaSanPham = $req->accessoryID;
                $photo->link = 'images/accessory/' . $req->accessoryID.'_'.$i . '.' . $file->getClientOriginalExtension();
                $photo->save();
                $i++;
            }
        }


        return redirect()->route('adminAllAccessories')->with('thanhcong','Sửa thành công');
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


        if($req->imgDeleteID!=''){
            $imgDeleteID=rtrim($req->imgDeleteID,",");
            $x = preg_split("/,/", $imgDeleteID);
            $image = DB::select("SELECT * FROM `tbl_anh` WHERE link LIKE '%$req->productID%'");
            foreach ($x as $delete){
                DB::delete('DELETE FROM `tbl_anh` WHERE IDAnh=?',[$image[$delete]->IDAnh]);
                unlink(public_path().'/'.$image[$delete]->link);
            }
        }

        $i=0;
        $newImage = DB::select("SELECT * FROM `tbl_anh` WHERE link LIKE '%$req->productID%'");
        foreach ($newImage as $img){
            $newLink = 'images/product/' . $req->productID.'_'.$i . '.' .preg_split("/[.]/", $img->link)[1];
            DB::update('UPDATE `tbl_anh` SET `link`=? WHERE IDAnh=? ',[$newLink,$img->IDAnh]);
            rename(public_path().'/'.$img->link,$newLink);
            $i++;
        }

        if($i>0){
            $product->AnhDaiDien= 'images/product/' . $req->productID.'_0.' .preg_split("/[.]/", $newImage[0]->link)[1];
        }elseif(isset($req->image)) {
            $product->AnhDaiDien= 'images/product/' . $req->productID.'_0.' . $req->image[0]->getClientOriginalExtension();
        }else{
            $product->AnhDaiDien = 'images/product/defaultProduct.png';

        }





        $product->save();

        if(isset($req->image)) {
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


        return redirect()->route('adminAllProduct')->with('thanhcong','Sửa thành công');
    }

    public function getDeleteProduct(Request $req){
        $product = Product::find($req->id);
        $product->TinhTrang = "Đã Xóa";
        $product->save();
        return redirect()->route('adminAllProduct');

    }

    public function getDeleteAccessory(Request $req){
        $accessory = Accessories::find($req->id);
        $accessory->TinhTrang = "Đã Xóa";
        $accessory->save();
        return redirect()->route('adminAllAccessories');

    }

    public function updateStatusProduct(Request $request){
        DB::update('UPDATE tbl_sanpham SET TinhTrang=? WHERE IDSanPham=?',[$request->status,$request->id]);
    }

    public function updateStatusAccessory(Request $request){
        DB::update('UPDATE tbl_phukien SET TinhTrang=? WHERE IDPhuKien=?',[$request->status,$request->id]);
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