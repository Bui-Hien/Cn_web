<?php

use models\Author;
use models\Category;

class AuthorController
{
    private $service;

    /**
     * @param $service
     */
    public function __construct()
    {
        $this->service = new AuthorService();
    }


    public function index()
    {
        $authors = $this->service->getAllAuthors();
        include "./views/author/index.php";
    }

    public function create()
    {
        include "./views/author/create.php";
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ten_tgia = $_POST['ten_tgia'];
            $hinhanh = '';
            if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['hinhanh']['tmp_name'];
                $fileName = $_FILES['hinhanh']['name'];
                $fileSize = $_FILES['hinhanh']['size'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Kiểm tra loại tệp và kích thước
                $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array($fileExtension, $allowedExtensions) && $fileSize < 5000000) { // < 5MB
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $uploadFileDir = './uploads/';

                    // Tạo thư mục nếu không tồn tại
                    if (!is_dir($uploadFileDir)) {
                        mkdir($uploadFileDir, 0755, true);
                    }

                    $dest_path = $uploadFileDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $hinhanh = $newFileName;
                    } else {
                        echo 'Lỗi khi tải lên tệp hình ảnh.';
                        exit();
                    }
                } else {
                    echo 'Định dạng tệp không hợp lệ hoặc tệp quá lớn.';
                    exit();
                }
                $author = $this->service->save(new  Author("", $ten_tgia, $hinhanh));
                if ($author != null) {
                    header('Location: /btth02v2/index.php?controller=Author&action=index');
                    exit(); // Kết thúc script để đảm bảo không có mã nào khác được thực thi sau redirect

                } else {
                    echo "Có lỗi gì đó";
                }
            }
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }

    public function delete()
    {

        if (isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            // Xác nhận xóa thể loại
            if ($id > 0) {
                try {
                    if ($this->service->destroy($id)) {
                        header('Location: /btth02v2/index.php?controller=Author&action=index');
                        exit();
                    } else {
                        echo '<p>Không tìm thấy tác giả để xóa.</p>';
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

    public function edit()
    {

        if (!empty($_GET['id'])) {
            $id = $_GET['id'];

            $author = $this->service->getAuthor($id);
            include "./views/author/edit.php";
        } else {
            echo "Không tồn tại bài viết.";
        }
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['ma_tgia'];
            $ten_tgia = $_POST['ten_tgia'];
            try {
                $hinhanh = '';
                if (!empty($_FILES['hinhanh']['name'])) {
                    $target_dir = "./uploads/";
                    $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
                    if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                        $hinhanh = basename($_FILES["hinhanh"]["name"]);
                    }
                }
                $author = $this->service->update(new  Author($id, $ten_tgia, $hinhanh));
                if ($author != null) {
                    header('Location: /btth02v2/index.php?controller=Author&action=index');
                    exit();

                } else {
                    echo "Có lỗi gì đó";
                }
            } catch (PDOException $e) {
                echo '<p>Lỗi: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
            }
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }
}