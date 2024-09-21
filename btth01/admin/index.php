<?php
global $pdo;
include '../config/connect.php';
$sql = "SELECT COUNT(*) AS total_users FROM users";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
$total_users = $row['total_users'];

// Truy vấn số lượng tác giả
$sql_authors = "SELECT COUNT(*) AS total_authors FROM tacgia";
$stmt_authors = $pdo->query($sql_authors);
$row_authors = $stmt_authors->fetch();
$total_authors = $row_authors['total_authors'];

// Truy vấn số lượng bài viết
$sql_posts = "SELECT COUNT(*) AS total_posts FROM baiviet";
$stmt_posts = $pdo->query($sql_posts);
$row_posts = $stmt_posts->fetch();
$total_posts = $row_posts['total_posts'];

$sql_categories = "SELECT COUNT(*) AS total_categories FROM theloai";
$stmt_categories = $pdo->query($sql_categories);
$row_categories = $stmt_categories->fetch();
$total_categories = $row_categories['total_categories'];

include 'header.php';
?>
<!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
<div class="row">
    <div class="col-sm-3">
        <div class="card mb-2" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title text-center">
                    <a href="" class="text-decoration-none">Người dùng</a>
                </h5>

                <h5 class="h1 text-center">
                    <?php
                    echo htmlspecialchars($total_users, ENT_QUOTES, 'UTF-8');
                    ?>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card mb-2" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title text-center">
                    <a href="/btth01/admin/category.php" class="text-decoration-none">Thể loại</a>
                </h5>

                <h5 class="h1 text-center">
                    <?php
                    echo htmlspecialchars($total_categories, ENT_QUOTES, 'UTF-8'); // Hiển thị số lượng người dùng
                    ?>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card mb-2" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title text-center">
                    <a href="/btth01/admin/author.php" class="text-decoration-none">Tác giả</a>
                </h5>

                <h5 class="h1 text-center">
                    <?php
                    echo htmlspecialchars($total_authors, ENT_QUOTES, 'UTF-8'); // Hiển thị số lượng người dùng
                    ?>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card mb-2" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title text-center">
                    <a href="/btth01/admin/article.php" class="text-decoration-none">Bài viết</a>
                </h5>

                <h5 class="h1 text-center">
                    <?php
                    echo htmlspecialchars($total_posts, ENT_QUOTES, 'UTF-8'); // Hiển thị số lượng người dùng
                    ?>
                </h5>
            </div>
        </div>
    </div>
</div>
</main>
<footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2"
        style="height:80px">
    <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>