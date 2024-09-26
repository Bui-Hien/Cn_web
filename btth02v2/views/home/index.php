<?php
if (empty($articles))
    $articles = array();
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
    <link rel="stylesheet" href="http://localhost/btth02v2/assets/css/style.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> <img src="http://localhost/btth02v2/assets/images/logo2.png" alt="" class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <a class="nav-link active" aria-current="page"
                       href="<?= textdomain("/btth02v2/index.php?controller=Home&action=index") ?>">Trang
                        chủ</a>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= textdomain("/btth02v2/index.php?controller=Home&action=showLogin") ?>">Đăng
                            nhập</a></li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Nội dung cần tìm" aria-label="Search">
                    <button class="btn btn-outline-success" type="button">Tìm</button>
                </form>
            </div>
        </div>
    </nav>
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <?php foreach ($articles as $index => $article): ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $index ?>"
                        class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : '' ?>"
                        aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner" style="height: 600px">
            <?php foreach ($articles as $index => $article): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="http://localhost/btth02v2/uploads/<?= $article->getHinhanh(); ?>"
                         class="d-block w-100" alt="Hình ảnh bài hát">
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
            <span class="carousel-control-next-icon text-primary" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</header>
<main class="container-fluid mt-3" style="min-height: 100vh">
    <h3 class="text-center text-uppercase mb-3 text-primary">TOP bài hát yêu thích</h3>
    <div class="row">
        <?php foreach ($articles as $article): ?>
            <div class="col-sm-3">
                <div class="card mb-2 d-flex flex-column" style="width: 100%;height: 100%">
                    <img src="http://localhost/btth02v2/uploads/<?= $article->getHinhanh(); ?>"
                         class="card-img-top" alt="Hình ảnh bài hát">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="<?= textdomain("/btth02v2/index.php?controller=Home&action=show&id=" . $article->getMaBviet()) ?>"
                               class="text-decoration-none">
                                <?= htmlspecialchars($article->getTieude(), ENT_QUOTES, 'UTF-8'); ?>
                            </a>

                        </h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2"
        style="height:80px">
    <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>
