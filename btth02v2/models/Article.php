<?php

namespace models;
require_once "Author.php";
require_once "Category.php";

use models\Author;

use models\Category;


class Article
{
    private $ma_bviet;
    private $tieude;
    private $ten_bhat;
    private $tomtat;
    private $noidung;
    private $tac_gia;
    private $the_loai;
    private $ngayviet;
    private $hinhanh;

    public function __construct($ma_bviet, $tieude, $ten_bhat, $tomtat, $noidung, $ma_tgia, $ten_tgia, $hinh_tgia, $ma_tloai, $ten_tloai, $ngayviet, $hinhanh)
    {
        $this->ma_bviet = $ma_bviet;
        $this->tieude = $tieude;
        $this->ten_bhat = $ten_bhat;
        $this->tomtat = $tomtat;
        $this->noidung = $noidung;

        // Initialize Author object with individual parameters
        $this->tac_gia = new Author($ma_tgia, $ten_tgia, $hinh_tgia);

        // Initialize Category object with individual parameters
        $this->the_loai = new Category($ma_tloai, $ten_tloai);

        $this->ngayviet = $ngayviet;
        $this->hinhanh = $hinhanh;
    }

    /**
     * @return mixed
     */
    public function getHinhanh()
    {
        return $this->hinhanh;
    }

    /**
     * @param mixed $hinhanh
     */
    public function setHinhanh($hinhanh)
    {
        $this->hinhanh = $hinhanh;
    }

    /**
     * @return mixed
     */
    public function getNgayviet()
    {
        return $this->ngayviet;
    }

    /**
     * @param mixed $ngayviet
     */
    public function setNgayviet($ngayviet)
    {
        $this->ngayviet = $ngayviet;
    }

    /**
     * @return \models\Category
     */
    public function getTheLoai()
    {
        return $this->the_loai;
    }

    /**
     * @param \models\Category $the_loai
     */
    public function setTheLoai($the_loai)
    {
        $this->the_loai = $the_loai;
    }

    /**
     * @return \models\Author
     */
    public function getTacGia()
    {
        return $this->tac_gia;
    }

    /**
     * @param \models\Author $tac_gia
     */
    public function setTacGia($tac_gia)
    {
        $this->tac_gia = $tac_gia;
    }

    /**
     * @return mixed
     */
    public function getNoidung()
    {
        return $this->noidung;
    }

    /**
     * @param mixed $noidung
     */
    public function setNoidung($noidung)
    {
        $this->noidung = $noidung;
    }

    /**
     * @return mixed
     */
    public function getTomtat()
    {
        return $this->tomtat;
    }

    /**
     * @param mixed $tomtat
     */
    public function setTomtat($tomtat)
    {
        $this->tomtat = $tomtat;
    }

    /**
     * @return mixed
     */
    public function getTenBhat()
    {
        return $this->ten_bhat;
    }

    /**
     * @param mixed $ten_bhat
     */
    public function setTenBhat($ten_bhat)
    {
        $this->ten_bhat = $ten_bhat;
    }

    /**
     * @return mixed
     */
    public function getTieude()
    {
        return $this->tieude;
    }

    /**
     * @param mixed $tieude
     */
    public function setTieude($tieude)
    {
        $this->tieude = $tieude;
    }

    /**
     * @return mixed
     */
    public function getMaBviet()
    {
        return $this->ma_bviet;
    }

    /**
     * @param mixed $ma_bviet
     */
    public function setMaBviet($ma_bviet)
    {
        $this->ma_bviet = $ma_bviet;
    }

}