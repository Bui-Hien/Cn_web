<?php
global $pdo;
include '../config/connect.php'; // Đảm bảo đường dẫn đúng

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['ma_bviet']) ? (int)$_POST['ma_bviet'] : 0;
    $tieude = isset($_POST['tieude']) ? $_POST['tieude'] : '';
    $ten_bhat = isset($_POST['ten_bhat']) ? $_POST['ten_bhat'] : '';
    $ma_tloai = isset($_POST['ma_tloai']) ? (int)$_POST['ma_tloai'] : 0;
    $tomtat = isset($_POST['tomtat']) ? $_POST['tomtat'] : '';
    $noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
    $ma_tgia = isset($_POST['ma_tgia']) ? (int)$_POST['ma_tgia'] : 0;

    try {
        // Xử lý hình ảnh (nếu có)
        $hinhanh = '';
        if (!empty($_FILES['hinhanh']['name'])) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                $hinhanh = basename($_FILES["hinhanh"]["name"]);
            }
        }

        // Chuẩn bị câu lệnh SQL để cập nhật thông tin bài viết
        $sql_update = "UPDATE baiviet SET tieude = :tieude, ten_bhat = :ten_bhat, ma_tloai = :ma_tloai, tomtat = :tomtat, noidung = :noidung, ma_tgia = :ma_tgia";
        if ($hinhanh) {
            $sql_update .= ", hinhanh = :hinhanh";
        }
        $sql_update .= " WHERE ma_bviet = :id";

        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->bindParam(':tieude', $tieude);
        $stmt_update->bindParam(':ten_bhat', $ten_bhat);
        $stmt_update->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
        $stmt_update->bindParam(':tomtat', $tomtat);
        $stmt_update->bindParam(':noidung', $noidung);
        $stmt_update->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);
        $stmt_update->bindParam(':id', $id, PDO::PARAM_INT);
        if ($hinhanh) {
            $stmt_update->bindParam(':hinhanh', $hinhanh);
        }
        $stmt_update->execute();

        header("Location: article.php");
        exit();

    } catch (PDOException $e) {
        echo '<p>Lỗi: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
    }
} else {
    echo '<p>Yêu cầu không hợp lệ.</p>';
}
?>
