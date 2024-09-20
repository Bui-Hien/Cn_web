<?php
global $pdo;
include '../config/connect.php'; // Đảm bảo đường dẫn đúng

// Kiểm tra xem có dữ liệu từ form không
if (isset($_POST['id'])) {
    $id = (int)$_POST['id']; // Lấy giá trị 'id' từ form và chuyển thành số nguyên

    // Xác nhận xóa thể loại
    if ($id > 0) {
        try {
            // Chuẩn bị câu lệnh SQL để xóa thể loại
            $sql = "DELETE FROM baiviet WHERE ma_bviet = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Thực thi câu lệnh
            $stmt->execute();

            // Kiểm tra xem có bị lỗi không
            if ($stmt->rowCount() > 0) {
                header('Location: article.php');
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

// Liên kết quay lại trang danh sách thể loại
echo '<a href="category.php">Quay lại danh sách thể loại</a>';
?>
