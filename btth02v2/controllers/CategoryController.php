<?php

use models\Category;

class CategoryController
{
    private $service;

    /**
     * @param $service
     */
    public function __construct()
    {
        $this->service = new CategoryService();
    }


    public function index()
    {
        $categories = $this->service->getAllCategories();
        include "./views/category/index.php";
    }

    public function create()
    {
        include "./views/category/create.php";
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ten_tloai = $_POST['ten_tloai'];
            $category = $this->service->save(new Category("", $ten_tloai));
            if ($category != null) {
                header('Location: /btth02v2/index.php?controller=Category&action=index');
                exit();
            } else {
                echo "Có lỗi gì đó";
            }
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }

    public
    function edit()
    {
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            $category = $this->service->getCategory($id);
            include "./views/category/edit.php";
        } else {
            echo "Không tồn tại thể loại.";
        }

    }

    public
    function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ma_tloai = $_POST['ma_tloai'];
            $ten_tloai = $_POST['ten_tloai'];
            $category = $this->service->update(new  Category($ma_tloai, $ten_tloai));
            print_r($category);
            if ($category != null) {
                header('Location: /btth02v2/index.php?controller=Category&action=index');
                exit(); // Kết thúc script để đảm bảo không có mã nào khác được thực thi sau redirect

            } else {
                echo "Có lỗi gì đó";
            }
        }
    }

    public
    function delete()
    {

        if (isset($_POST['id'])) {
            $id = (int)$_POST['id'];

            if ($id > 0) {
                try {
                    if ($this->service->destroy($id)) {
                        header('Location: /btth02v2/index.php?controller=Category&action=index');
                        exit();
                    } else {
                        echo '<p>Không tìm thấy thể loại để xóa.</p>';
                    }
                } catch (PDOException $e) {
                    echo '<p>Lỗi: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
                }
            } else {
                echo '<p>ID không hợp lệ.</p>';
            }
        } else {
            echo '<p>ID không được cung cấp.</p>';
        }
    }

}