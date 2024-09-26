<?php

use models\Article;

class ArticleController
{
    private $service;

    /**
     * @param $service
     */
    public function __construct()
    {
        $this->service = new ArticleService();;
    }

    public function index()
    {
        $articles = $this->service->getAllArticleWithAuthorWithCategory();
        include "./views/article/index.php";
    }

    public function create()
    {
        $authorService = new AuthorService();
        $categoryService = new CategoryService();
        $authors = $authorService->getAllAuthors();
        $categories = $categoryService->getAllCategories();
        include "./views/article/create.php";
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $tieude = $_POST['tieude'];
            $ten_bhat = $_POST['ten_bhat'];
            $ma_tloai = $_POST['ma_tloai'];
            $tomtat = $_POST['tomtat'];
            $noidung = $_POST['noidung'];
            $ma_tgia = $_POST['ma_tgia'];
            $ngayviet = date('Y-m-d');  // Ngày hiện tại

            // Xử lý tệp hình ảnh
            $hinhanh = '';
            if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['hinhanh']['tmp_name'];
                $fileName = $_FILES['hinhanh']['name'];
                $fileSize = $_FILES['hinhanh']['size'];
                $fileType = $_FILES['hinhanh']['type'];
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
                $article = $this->service->store(new  Article("", $tieude,
                    $ten_bhat, $tomtat, $noidung,
                    $ma_tgia, "", "",
                    $ma_tloai, "", $ngayviet,
                    $hinhanh));
                if ($article != null) {
                    header('Location: /btth02v2/index.php?controller=Article&action=index');
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
            $id = (int)$_POST['id']; // Lấy giá trị 'id' từ form và chuyển thành số nguyên

            // Xác nhận xóa thể loại
            if ($id > 0) {
                try {
                    if ($this->service->destroy($id)) {
                        header('Location: /btth02v2/index.php?controller=Article&action=index');
                        exit();
                    } else {
                        echo '<p>Không tìm thấy bài viết để xóa.</p>';
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

            $authorService = new AuthorService();
            $categoryService = new CategoryService();
            $authors = $authorService->getAllAuthors();
            $categories = $categoryService->getAllCategories();
            $article = $this->service->getAllArticle($id);
            include "./views/article/edit.php";
        } else {
            echo "Không tồn tại bài viết.";
        }
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['ma_bviet'];
            $tieude = $_POST['tieude'];
            $ten_bhat = $_POST['ten_bhat'];
            $ma_tloai = $_POST['ma_tloai'];
            $tomtat = $_POST['tomtat'];
            $noidung = $_POST['noidung'];
            $ma_tgia = $_POST['ma_tgia'];
            echo $id;
            try {
                $hinhanh = '';
                if (!empty($_FILES['hinhanh']['name'])) {
                    $target_dir = "./uploads/";
                    $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
                    if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                        $hinhanh = basename($_FILES["hinhanh"]["name"]);
                    }
                }
                $article = $this->service->update(new  Article($id, $tieude,
                    $ten_bhat, $tomtat, $noidung,
                    $ma_tgia, "", "",
                    $ma_tloai, "", "",
                    $hinhanh));
                if ($article != null) {
                    header('Location: /btth02v2/index.php?controller=Article&action=index');
                    exit(); // Kết thúc script để đảm bảo không có mã nào khác được thực thi sau redirect

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
