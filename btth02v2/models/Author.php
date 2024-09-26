<?php

namespace models;

class Author
{
    private $ma_tgia;      // Author ID
    private $ten_tgia;   // Author Name
    private $hinh_tgia; // Author Image (nullable)

    /**
     * @param $ma_tgia
     * @param $ten_tgia
     * @param null|string $hinh_tgia
     */
    public function __construct($ma_tgia, $ten_tgia, $hinh_tgia)
    {
        $this->ma_tgia = $ma_tgia;
        $this->ten_tgia = $ten_tgia;
        $this->hinh_tgia = $hinh_tgia;
    }

    /**
     * @return mixed
     */
    public function getMaTgia()
    {
        return $this->ma_tgia;
    }

    /**
     * @param mixed $ma_tgia
     */
    public function setMaTgia($ma_tgia)
    {
        $this->ma_tgia = $ma_tgia;
    }

    /**
     * @return mixed
     */
    public function getTenTgia()
    {
        return $this->ten_tgia;
    }

    /**
     * @param mixed $ten_tgia
     */
    public function setTenTgia($ten_tgia)
    {
        $this->ten_tgia = $ten_tgia;
    }

    /**
     * @return mixed|null
     */
    public function getHinhTgia()
    {
        return $this->hinh_tgia;
    }

    /**
     * @param mixed|null $hinh_tgia
     */
    public function setHinhTgia($hinh_tgia)
    {
        $this->hinh_tgia = $hinh_tgia;
    }

}
