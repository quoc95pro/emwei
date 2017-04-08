<?php
/**
 * Created by PhpStorm.
 * User: quoc95
 * Date: 4/3/2017
 * Time: 10:57 AM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\View\View;

class pageController extends \Illuminate\Routing\Controller
{
      public function index(){
          $newProduct = DB::select('SELECT * FROM `tbl_anh`,`tbl_sanpham` WHERE tbl_anh.MaSanPham=tbl_sanpham.IDSanPham ORDER BY tbl_sanpham.IDSanPham DESC LIMIT 5');
          $slide = DB::select('SELECT * FROM `tbl_anh`,`tbl_sanpham` WHERE tbl_anh.MaSanPham=tbl_sanpham.IDSanPham LIMIT 3');
          $left=DB::select('SELECT HangSanXuat,COUNT(*) AS Count FROM `tbl_sanpham` GROUP BY HangSanXuat');
          $tabTitle=DB::select('SELECT LoaiPhuKien from `tbl_phukien` GROUP BY LoaiPhukien');
          $tabContent=DB::select('SELECT * FROM `tbl_anhphukien`,`tbl_phukien` WHERE tbl_anhphukien.MaSanPham=tbl_phukien.IDPhuKien ORDER BY tbl_phukien.IDPhuKien DESC LIMIT 5');
          return view('index', ['newProducts' => $newProduct],['slide' => $slide])
              ->with(['left' => $left])
              ->with(['tabTitle'=>$tabTitle])
              ->with(['tabContent'=>$tabContent]);
      }

      public function login(){
          return \view('login');
      }
}