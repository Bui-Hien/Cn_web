<?php
if (empty($total_users)) {
    $total_users = 0;
}
if (empty($total_categories)) {
    $total_categories = 0;
}
if (empty($total_authors)) {
    $total_authors = 0;
}
if (empty($total_posts)) {
    $total_posts = 0;
}
?>
<div class="row mt-5">
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
                    <a href="<?= textdomain("/btth02v2/index.php?controller=Category&action=index") ?>"
                       class="text-decoration-none">Thể loại</a>
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
                    <a href="<?= textdomain("/btth02v2/index.php?controller=Author&action=index") ?>"
                       class="text-decoration-none">Tác giả</a>
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
                    <a href="<?= textdomain("/btth02v2/index.php?controller=Article&action=index") ?>"
                       class="text-decoration-none">Bài viết</a>
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