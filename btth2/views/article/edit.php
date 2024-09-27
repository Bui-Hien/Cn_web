<?php
include_once "./views/layout/header.php";

use models\Article;
use models\Author;
use models\Category;

if (empty($article) || empty($authors) || empty($categories)) {
    $article = new Article();
    $authors = array(new Author());
    $categories = array(new Category());
}
?>

<div class="row">
    <div class="col-sm">
        <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>
        <form action="<?= textdomain("/btth02v2/index.php?controller=Article&action=update") ?>" method="post"
              enctype="multipart/form-data">
            <input name="ma_bviet" value="<?= $article->getMaBviet() ?>" style="display: none">
            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblTitle">Tiêu đề</span>
                <input type="text" class="form-control" name="tieude"
                       value="<?= htmlspecialchars($article->getTieude()) ?>" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblSongName">Tên bài hát</span>
                <input type="text" class="form-control" name="ten_bhat"
                       value="<?= htmlspecialchars($article->getTenBhat()) ?>" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblCategory">Thể loại</span>
                <select class="form-control" name="ma_tloai" required>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category->getMaTloai() ?>"
                            <?= $article->getTheLoai()->getMaTloai() == $category->getMaTloai() ? 'selected' : '' ?>
                        >
                            <?= $category->getTenTloai() ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblSummary">Tóm tắt</span>
                <textarea class="form-control" name="tomtat" rows="3"
                          required><?= htmlspecialchars($article->getTomtat()) ?></textarea>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblContent">Nội dung</span>
                <textarea class="form-control" name="noidung" rows="5"
                          required><?= htmlspecialchars($article->getNoidung()) ?></textarea>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblAuthorId">Tác giả</span>
                <select class="form-control" name="ma_tgia" required>
                    <option value="" disabled>Chọn tác giả</option>
                    <?php foreach ($authors as $author) { ?>
                        <option value="<?= $author->getMaTgia() ?>"
                            <?= $article->getTacGia()->getMaTgia() == $author->getMaTgia() ? 'selected' : '' ?>
                        >
                            <?= $author->getTenTgia() ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblImage">Hình ảnh</span>
                <input type="file" class="form-control" name="hinhanh" id="fileInput" accept="image/*">
            </div>

            <div class="mt-3 mb-3">
                <img id="imagePreview" src="http://localhost/btth02v2/uploads/<?= $article->getHinhanh(); ?>"
                     alt="Preview Image" style="max-width: 200px;">
            </div>

            <div class="form-group float-end">
                <input type="submit" value="Lưu lại" class="btn btn-success">
                <a href="<?= textdomain("/btth02v2/index.php?controller=Article&action=index") ?>"
                   class="btn btn-warning">Quay lại</a>
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
