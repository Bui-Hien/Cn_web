<?php
session_start(); // Bắt đầu phiên làm việc

// Kết nối đến cơ sở dữ liệu
global $pdo;
include 'config/connect.php';

// Lấy dữ liệu từ form
$username = $_POST['username'];
$password = $_POST['password'];

// Kiểm tra nếu các giá trị không rỗng
if (!empty($username) && !empty($password)) {
    // Chuẩn bị câu lệnh SQL
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);

    // Liên kết tham số
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    // Thực hiện câu lệnh
    $stmt->execute();

    // Kiểm tra nếu có kết quả
    if ($stmt->rowCount() > 0) {
        // Lưu tên người dùng vào session
        $_SESSION['username'] = $username;

        // Chuyển hướng đến trang quản trị
        header("Location: admin/index.php");
        exit();
    } else {
        echo "Tên người dùng hoặc mật khẩu không chính xác.";
    }
} else {
    echo "Vui lòng nhập đầy đủ thông tin.";
}
?>
