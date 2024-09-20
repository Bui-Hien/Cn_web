<?php
// Kết nối đến cơ sở dữ liệu
global $pdo;
include '../config/connect.php';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $category_name = trim($_POST['txtCatName']);

    // Kiểm tra xem tên thể loại có rỗng không
    if (!empty($category_name)) {
        // Chuẩn bị câu lệnh SQL để thêm thể loại mới
        $sql = "INSERT INTO theloai (ten_tloai) VALUES (:ten_tloai)";

        // Chuẩn bị truy vấn với PDO
        $stmt = $pdo->prepare($sql);

        // Gán giá trị tham số
        $stmt->bindParam(':ten_tloai', $category_name);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            // Chuyển hướng về trang quản lý thể loại với thông báo thành công
            header("Location: category.php");
            exit();
        } else {
            echo "Có lỗi xảy ra khi thêm thể loại.";
        }
    } else {
        echo "Vui lòng nhập tên thể loại.";
    }
}
?>
