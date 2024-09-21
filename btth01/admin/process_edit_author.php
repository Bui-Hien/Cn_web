<?php
global $pdo;
include '../config/connect.php'; // Đảm bảo đường dẫn đúng

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['ma_tgia']) ? (int)$_POST['ma_tgia'] : 0;
    $ten_tgia = isset($_POST['ten_tgia']) ? trim($_POST['ten_tgia']) : "";

    if ($id <= 0 || empty($ten_tgia)) {
        echo '<p>ID hoặc tên tác giả không hợp lệ.</p>';
        exit();
    }

    try {
        // Xử lý hình ảnh (nếu có)
        $hinhanh = '';
        if (!empty($_FILES['hinhanh']['name'])) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Kiểm tra loại file
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allowed_types)) {
                echo '<p>Chỉ hỗ trợ các định dạng ảnh: JPG, JPEG, PNG, GIF.</p>';
                exit();
            }

            // Kiểm tra kích thước file
            if ($_FILES["hinhanh"]["size"] > 5000000) { // 5MB
                echo '<p>Kích thước file quá lớn.</p>';
                exit();
            }

            // Di chuyển file
            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                $hinhanh = basename($_FILES["hinhanh"]["name"]);
            } else {
                echo '<p>Không thể tải lên hình ảnh.</p>';
                exit();
            }
        }

        // Chuẩn bị câu lệnh SQL để cập nhật thông tin tác giả
        $sql_update = "UPDATE tacgia SET ten_tgia = :ten_tgia";
        if ($hinhanh) {
            $sql_update .= ", hinh_tgia = :hinhanh";
        }
        $sql_update .= " WHERE ma_tgia = :id";

        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->bindParam(':ten_tgia', $ten_tgia);
        $stmt_update->bindParam(':id', $id, PDO::PARAM_INT);
        if ($hinhanh) {
            $stmt_update->bindParam(':hinhanh', $hinhanh);
        }
        $stmt_update->execute();

        header("Location: author.php");
        exit();

    } catch (PDOException $e) {
        echo '<p>Lỗi: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
    }
} else {
    echo '<p>Yêu cầu không hợp lệ.</p>';
}
?>
