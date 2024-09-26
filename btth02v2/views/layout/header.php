<?php
$fileName = isset($_GET['controller']) ? $_GET['controller'] : '';
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
    <link rel="stylesheet" href="http://localhost/btth02v2/assets/css/style.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
        <div class="container-fluid">
            <div class="h3">
                <a class="navbar-brand"
                   href="<?= textdomain("/btth02v2/index.php?controller=Auth&action=homeAdmin") ?>">Administration</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page"
                           href="<?= textdomain("/btth02v2/index.php?controller=Auth&action=homeAdmin") ?>">Trang
                            chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= textdomain("/btth02v2/index.php?controller=Home&action=index") ?>">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link   <?= $fileName == 'Category' ? "active fw-bold" : "" ?>"
                           href="<?= textdomain("/btth02v2/index.php?controller=Category&action=index") ?>">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= $fileName == 'Author' ? "active fw-bold" : "" ?>"
                           href="<?= textdomain("/btth02v2/index.php?controller=Author&action=index") ?>">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= $fileName == 'Article' ? "active fw-bold" : "" ?> "
                           href="<?= textdomain("/btth02v2/index.php?controller=Article&action=index") ?>">Bài viết</a>
                    </li>
                </ul>
                <a class="navbar-brand"
                   href="<?= textdomain("/btth02v2/index.php?controller=Auth&action=logout") ?>">Logout</a>
            </div>
        </div>
    </nav>

</header>
<main style="min-height: 100vh">