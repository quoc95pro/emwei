<?php
/**
 * Created by PhpStorm.
 * User: quoc95
 * Date: 4/3/2017
 * Time: 10:57 AM
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Integer;

class pageController extends \Illuminate\Routing\Controller
{
      public function index(){
          $newProduct = DB::select('SELECT * FROM `tbl_anh`,`tbl_sanpham` WHERE tbl_anh.MaSanPham=tbl_sanpham.IDSanPham ORDER BY tbl_sanpham.IDSanPham DESC LIMIT 5');
          $slide = DB::select('SELECT * FROM `tbl_anh`,`tbl_sanpham` WHERE tbl_anh.MaSanPham=tbl_sanpham.IDSanPham LIMIT 3');
          $left=DB::select('SELECT HangSanXuat,COUNT(*) AS Count FROM `tbl_sanpham` GROUP BY HangSanXuat');
          $tabTitle=DB::select('SELECT LoaiPhuKien from `tbl_phukien` GROUP BY LoaiPhukien');
          $tabContent=DB::select('SELECT * FROM `tbl_anhphukien`,`tbl_phukien` WHERE tbl_anhphukien.MaSanPham=tbl_phukien.IDPhuKien ORDER BY tbl_phukien.IDPhuKien DESC LIMIT 5');
          return view('page.index', ['newProducts' => $newProduct],['slide' => $slide])
              ->with(['left' => $left])
              ->with(['tabTitle'=>$tabTitle])
              ->with(['tabContent'=>$tabContent]);
      }

      public function login(){
          return \view('page.login');
      }
    public function contactUs(){
        return \view('page.contact-us');
    }

    public function checkout(){
        return \view('page.checkout');
    }

    public function cart(){
        return \view('page.cart');
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

    public function detail(){
        return \view('page.product-details');
    }

    public function shop(){
        return \view('page.shop');
    }

    public function listProductPhone(){
        $listProduct = DB::select('SELECT * FROM `tbl_anh`,`tbl_sanpham` WHERE tbl_anh.MaSanPham=tbl_sanpham.IDSanPham AND LoaiSanPham = \'Điện thoại\'');
        return \view('page.shop')
            ->with(['listProduct'=>$listProduct]);
    }
    public function admin(){
            return \view('admin.index');

    }

    public function widgets(){
        return \view('admin.widgets');

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
        return \view('admin.login');

    }

    public function adminAllProduct(){
        $listProduct = DB::select('SELECT * FROM `tbl_anh`,`tbl_sanpham` WHERE tbl_anh.MaSanPham=tbl_sanpham.IDSanPham');
        return \view('admin.Product')
            ->with(['listProduct'=>$listProduct]);

    }

    public function adminAddProduct(){
        $productTypes = DB::select('SELECT LoaiSanPham FROM `tbl_sanpham` GROUP BY LoaiSanPham');
        $companies = DB::select('SELECT HangSanXuat FROM `tbl_sanpham` GROUP BY HangSanXuat');
        return \view('admin.addproduct')
            ->with(['productTypes'=>$productTypes])
            ->with(['companies'=>$companies])
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
}