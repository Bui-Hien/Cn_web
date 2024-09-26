<?php

namespace models;

class Category
{
    private $ma_tloai;     // Category ID
    private $ten_tloai;  // Category Name

    /**
     * @param $ma_tloai
     * @param $ten_tloai
     */
    public function __construct($ma_tloai, $ten_tloai)
    {
        $this->ma_tloai = $ma_tloai;
        $this->ten_tloai = $ten_tloai;
    }

    /**
     * @return mixed
     */
    public function getMaTloai()
    {
        return $this->ma_tloai;
    }

    /**
     * @param mixed $ma_tloai
     */
    public function setMaTloai($ma_tloai)
    {
        $this->ma_tloai = $ma_tloai;
    }

    /**
     * @return mixed
     */
    public function getTenTloai()
    {
        return $this->ten_tloai;
    }

    /**
     * @param mixed $ten_tloai
     */
    public function setTenTloai($ten_tloai)
    {
        $this->ten_tloai = $ten_tloai;
    }

    /**
     * @param $ma_tloai
     * @param $ten_tloai
     */

}