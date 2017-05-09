<?php
/**
 * Created by PhpStorm.
 * User: quoc95
 * Date: 5/2/2017
 * Time: 3:19 PM
 */

namespace App\Http\Controllers;
use App\Customer;
use  App\Product;
use App\Photo;
use App\Description;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ProductType;
use function redirect;
use function route;
use function session;
use Gloudemans\Shoppingcart\Facades\Cart;

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
            session(['userName' => $user->TenKhachHang]);
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
                $newUser->save();
        return $this->index();
    }



    public function contactUs(){
        return \view('page.contact-us');
    }

    public function checkout(){
        return \view('page.checkout');
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
        $a = '';
        foreach ($product as $p){
            $a = $p->LoaiSanPham;
        }
        $relateProduct = DB::select("SELECT * FROM `tbl_sanpham` WHERE  LoaiSanPham='$a' ORDER BY IDSanPham DESC  limit 6");
        return \view('page.product-details')
            ->with(['product'=>$product])
            ->with(['relateProduct'=>$relateProduct]);
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
            $price=Cart::get($rowId)->price;
            echo number_format($price*$qty, 0, ',', '.');
        }
    }

    public function cart_delete(Request $req){
        if($req->ajax()){
            $rowId = $req->id;
            Cart::remove($rowId);
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
        return \view('admin.index');

    }

    public function widgets(){
        return \view('admin.widgets');

    }
    public function test(){
       return "test";
    }

    public function charts(){
        return \view('admin.charts');

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
        $product->save();


//         foreach ($req->image as $img)
//             $filename+= $img->store('photos');
        if(isset($req->image)) {
            foreach ($req->image as $file) {
                $path = public_path() . '/images/product/';
                $file->move($path, $req->productID . '.' . $file->getClientOriginalExtension());
                $photo = new Photo();
                $photo->MaSanPham = $req->productID;
                $photo->link = 'images/product/' . $req->productID . '.' . $file->getClientOriginalExtension();
                $photo->save();
            }
        }else{
            $photo = new Photo();
            $photo->MaSanPham = $req->productID;
            $photo->link = 'images/product/defaultProduct.png';
            $photo->save();
            }


        return redirect()->back()->with('thanhcong','Thêm thành công');
    }

    public function getEditProduct(Request $req){
        $product = DB::select("SELECT * FROM `tbl_sanpham` WHERE IDSanPham='$req->id'");
        $productTypes = DB::select('SELECT LoaiSanPham FROM `tbl_sanpham` GROUP BY LoaiSanPham');
        $companies = DB::select('SELECT HangSanXuat FROM `tbl_sanpham` GROUP BY HangSanXuat');
        $description = DB::select('SELECT * FROM `tbl_motasanpham`');

        return \view('admin.edit')
            ->with(['product'=>$product])
            ->with(['productTypes'=>$productTypes])
            ->with(['companies'=>$companies])
            ->with(['description'=>$description])
            ->with(['nextID'=>$this->NextID()]);



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


}