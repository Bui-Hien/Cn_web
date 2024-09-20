<?php
// Kết nối đến cơ sở dữ liệu
global $pdo;
include '../config/connect.php';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $category_name = $_POST['txtCatName'];
    $category_id = $_POST['txtCatId'];

    // Kiểm tra xem tên thể loại và ID có rỗng không
    if (!empty($category_name) && !empty($category_id)) {
        // Chuẩn bị câu lệnh SQL để cập nhật thể loại
        $sql = "UPDATE theloai SET ten_tloai = :ten_tloai WHERE ma_tloai = :ma_tloai";

        // Chuẩn bị truy vấn với PDO
        $stmt = $pdo->prepare($sql);

        // Gán giá trị tham số
        $stmt->bindParam(':ten_tloai', $category_name);
        $stmt->bindParam(':ma_tloai', $category_id);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            // Chuyển hướng về trang quản lý thể loại với thông báo thành công
            header("Location: category.php");
            exit();
        } else {
            echo "Có lỗi xảy ra khi cập nhật thể loại.";
        }
    } else {
        echo "Vui lòng nhập tên thể loại và ID thể loại.";
    }
}
?>
