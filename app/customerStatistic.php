<?php
/**
 * Created by PhpStorm.
 * User: quoc95
 * Date: 6/15/2017
 * Time: 10:15 AM
 */

namespace App;


class customerStatistic
{
    private $maDH;
    private $email;
    private $ten;
    private $masp;
    private $tensp;
    private $soLuong;
    private $ngayMua;

    /**
     * customerStatistic constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getMaDH()
    {
        return $this->maDH;
    }

    /**
     * @param mixed $maDH
     */
    public function setMaDH($maDH)
    {
        $this->maDH = $maDH;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTen()
    {
        return $this->ten;
    }

    /**
     * @param mixed $ten
     */
    public function setTen($ten)
    {
        $this->ten = $ten;
    }

    /**
     * @return mixed
     */
    public function getMasp()
    {
        return $this->masp;
    }

    /**
     * @param mixed $masp
     */
    public function setMasp($masp)
    {
        $this->masp = $masp;
    }

    /**
     * @return mixed
     */
    public function getTensp()
    {
        return $this->tensp;
    }

    /**
     * @param mixed $tensp
     */
    public function setTensp($tensp)
    {
        $this->tensp = $tensp;
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

    /**
     * @return mixed
     */
    public function getNgayMua()
    {
        return $this->ngayMua;
    }

    /**
     * @param mixed $ngayMua
     */
    public function setNgayMua($ngayMua)
    {
        $this->ngayMua = $ngayMua;
    }


}