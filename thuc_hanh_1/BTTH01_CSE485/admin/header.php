<?php


session_start(); // Bắt đầu phiên làm việc

// Kiểm tra nếu người dùng chưa đăng nhập
if (empty($_SESSION['username'])) {
    // Chuyển hướng người dùng đến trang đăng nhập hoặc trang khác
    header("Location: home.php");
    exit(); // Dừng thực thi mã tiếp theo
}

$url = $_SERVER['REQUEST_URI'];

// Tách các phần của đường dẫn URL
$pathSegments = explode('/', trim($url, '/'));

// Lấy phần cuối cùng của đường dẫn
$lastSegment = end($pathSegments);

// Tách tên file khỏi phần mở rộng
$fileName = pathinfo($lastSegment, PATHINFO_FILENAME);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
        <div class="container-fluid">
            <div class="h3">
                <a class="navbar-brand" href="index.php">Administration</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($fileName, 'category') ? "active fw-bold" : "" ?>"
                           href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($fileName, 'author') ? "active fw-bold" : "" ?> "
                           href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($fileName, 'article') ? "active fw-bold" : "" ?> "
                           href="article.php">Bài viết</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
<main class="container mt-5 mb-5" style="min-height: 100vh">