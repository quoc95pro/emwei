<?php
/**
 * Created by PhpStorm.
 * User: quoc95
 * Date: 6/5/2017
 * Time: 9:46 AM
 */

namespace App;


class ProductPerBill
{
    private $maSanPham;
    private $tenSanPham;
    private $loaiSanPham;
    private $anhDaiDien;
    private $soLuong;

    /**
     * ProductPerBill constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getMaSanPham()
    {
        return $this->maSanPham;
    }

    /**
     * @param mixed $maSanPham
     */
    public function setMaSanPham($maSanPham)
    {
        $this->maSanPham = $maSanPham;
    }

    /**
     * @return mixed
     */
    public function getTenSanPham()
    {
        return $this->tenSanPham;
    }

    /**
     * @param mixed $tenSanPham
     */
    public function setTenSanPham($tenSanPham)
    {
        $this->tenSanPham = $tenSanPham;
    }

    /**
     * @return mixed
     */
    public function getLoaiSanPham()
    {
        return $this->loaiSanPham;
    }

    /**
     * @param mixed $loaiSanPham
     */
    public function setLoaiSanPham($loaiSanPham)
    {
        $this->loaiSanPham = $loaiSanPham;
    }

    /**
     * @return mixed
     */
    public function getAnhDaiDien()
    {
        return $this->anhDaiDien;
    }

    /**
     * @param mixed $anhDaiDien
     */
    public function setAnhDaiDien($anhDaiDien)
    {
        $this->anhDaiDien = $anhDaiDien;
    }

    /**
     * @return mixed
     */
    public function getSoLuong()
    {
        return $this->soLuong;
    }

    /**
     * @param mixed $soLuong
     */
    public function setSoLuong($soLuong)
    {
        $this->soLuong = $soLuong;
    }


}