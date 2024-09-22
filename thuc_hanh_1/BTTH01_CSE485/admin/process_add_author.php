<?php
global $pdo;
include '../config/connect.php';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tentgia = $_POST['ten_tgia'];

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
            $uploadFileDir = '../uploads/';

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
    }

    // Chuẩn bị câu lệnh SQL để thêm bài viết mới
    $sql = "INSERT INTO tacgia (ten_tgia, hinh_tgia)
            VALUES (:ten_tgia, :hinh_tgia)";

    // Chuẩn bị truy vấn với PDO
    $stmt = $pdo->prepare($sql);

    // Gán giá trị tham số
    $stmt->bindParam(':ten_tgia', $tentgia);
    $stmt->bindParam(':hinh_tgia', $hinhanh);

    // Thực thi truy vấn
    if ($stmt->execute()) {
        // Chuyển hướng về trang quản lý bài viết với thông báo thành công
        header("Location: author.php");
        exit();
    } else {
        echo "Có lỗi xảy ra khi thêm bài viết.";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
