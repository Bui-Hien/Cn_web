<?php
include_once "./views/layout/header.php";
use models\Author;

if (empty($author)) {
    $author = new Author();
}
?>
<div class="row mt-5">
    <div class="col-sm">
        <h3 class="text-center text-uppercase fw-bold">Chỉnh sửa tác giả</h3>
        <form action="<?= textdomain("/btth02v2/index.php?controller=Author&action=update") ?>" method="post"
              enctype="multipart/form-data">
            <input type="hidden" name="ma_tgia" value="<?= $author->getMaTgia() ?>">

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblAuthorName">Tên tác giả</span>
                <input type="text" class="form-control" name="ten_tgia" id="ten_tgia"
                       value="<?= $author->getTenTgia() ?>" required>
            </div>
            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblImage">Hình ảnh</span>
                <input type="file" class="form-control" name="hinhanh" id="fileInput" accept="image/*">
            </div>

            <div class="mt-3 mb-3">
                <img id="imagePreview" src="http://localhost/btth02v2/uploads/<?= $author->getHinhTgia(); ?>"
                     alt="Preview Image" style="max-width: 200px;">
            </div>

            <div class="form-group float-end">
                <input type="submit" value="Lưu lại" class="btn btn-success">
                <a href="<?= textdomain("/btth02v2/index.php?controller=Author&action=index") ?>"
                   class="btn btn-warning">Quay lại</a></div>
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
