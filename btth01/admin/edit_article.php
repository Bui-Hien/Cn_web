<?php
global $pdo;
include '../config/connect.php'; // Đảm bảo đường dẫn đúng

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Chuyển đổi ID sang kiểu số nguyên để bảo mật

    // Xác nhận ID hợp lệ
    if ($id > 0) {
        try {
            // Chuẩn bị câu lệnh SQL để lấy thông tin bài viết
            $sql_article = "SELECT *, tacgia.ten_tgia, theloai.ten_tloai FROM baiviet
                            JOIN tacgia ON tacgia.ma_tgia = baiviet.ma_tgia
                            JOIN theloai ON theloai.ma_tloai = baiviet.ma_tloai 
                            WHERE ma_bviet = :id";
            $stmt_article = $pdo->prepare($sql_article);
            $stmt_article->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_article->execute();
            $article = $stmt_article->fetch();

            if (empty($article)) {
                echo '<p>Không tìm thấy bài viết với ID này.</p>';
                exit();
            }

            // Lấy danh sách thể loại
            $sql_categories = "SELECT * FROM theloai";
            $stmt_categories = $pdo->query($sql_categories);
            $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

            // Lấy danh sách tác giả
            $sql_authors = "SELECT * FROM tacgia";
            $stmt_authors = $pdo->query($sql_authors);
            $authors = $stmt_authors->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo '<p>Lỗi: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
        }
    } else {
        echo '<p>ID không hợp lệ.</p>';
    }
} else {
    echo '<p>ID không được cung cấp.</p>';
}
include 'header.php';
?>

<div class="row">
    <div class="col-sm">
        <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>
        <form action="process_edit_article.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="ma_bviet" value="<?= htmlspecialchars($article['ma_bviet']) ?>">

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblTitle">Tiêu đề</span>
                <input type="text" class="form-control" name="tieude"
                       value="<?= htmlspecialchars($article['tieude']) ?>" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblSongName">Tên bài hát</span>
                <input type="text" class="form-control" name="ten_bhat"
                       value="<?= htmlspecialchars($article['ten_bhat']) ?>" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblCategory">Thể loại</span>
                <select class="form-control" name="ma_tloai" required>
                    <option value="" disabled>Chọn thể loại</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category['ma_tloai'] ?>" <?= $article['ma_tloai'] == $category['ma_tloai'] ? 'selected' : '' ?>><?= $category['ten_tloai'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblSummary">Tóm tắt</span>
                <textarea class="form-control" name="tomtat" rows="3"
                          required><?= htmlspecialchars($article['tomtat']) ?></textarea>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblContent">Nội dung</span>
                <textarea class="form-control" name="noidung" rows="5"
                          required><?= htmlspecialchars($article['noidung']) ?></textarea>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblAuthorId">Tác giả</span>
                <select class="form-control" name="ma_tgia" required>
                    <option value="" disabled>Chọn tác giả</option>
                    <?php foreach ($authors as $author) { ?>
                        <option value="<?= $author['ma_tgia'] ?>" <?= $article['ma_tgia'] == $author['ma_tgia'] ? 'selected' : '' ?>><?= $author['ten_tgia'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblImage">Hình ảnh</span>
                <input type="file" class="form-control" name="hinhanh" id="fileInput" accept="image/*">
            </div>

            <div class="mt-3 mb-3">
                <?php if (!empty($article['hinhanh'])): ?>
                    <img id="imagePreview" src="../uploads/<?= htmlspecialchars($article['hinhanh']) ?>"
                         alt="Preview Image" style="max-width: 200px;">
                <?php else: ?>
                    <img id="imagePreview" src="#" alt="Preview Image" style="display:none; max-width: 200px;">
                <?php endif; ?>
            </div>

            <div class="form-group float-end">
                <input type="submit" value="Lưu lại" class="btn btn-success">
                <a href="article.php" class="btn btn-warning">Quay lại</a>
            </div>
        </form>
        <script>
            document.getElementById('fileInput').addEventListener('change', function (event) {
                var input = event.target;
                var file = input.files[0];
                var preview = document.getElementById('imagePreview');

                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '#';
                    preview.style.display = 'none';
                }
            });
        </script>
    </div>
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
