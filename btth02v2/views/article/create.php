<?php
if (empty($authors) || empty($categories)) {
    $authors = array(new \models\Author());
    $categories = array(new \models\Category());
}
?>
<div class="row">
    <div class="col-sm">
        <h3 class="text-center text-uppercase fw-bold">Thêm mới bài viết</h3>
        <form action="<?= textdomain("/btth02v2/index.php?controller=Article&action=store") ?>" method="post"
              enctype="multipart/form-data">
            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblTitle">Tiêu đề</span>
                <input type="text" class="form-control" name="tieude" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblSongName">Tên bài hát</span>
                <input type="text" class="form-control" name="ten_bhat" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblCategory">Thể loại</span>
                <select class="form-control" name="ma_tloai" required>
                    <option value="" disabled selected>Chọn thể loại</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category->getMaTloai() ?>"><?= $category->getTenTloai() ?></option>";
                    <?php } ?>
                </select>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblSummary">Tóm tắt</span>
                <textarea class="form-control" name="tomtat" rows="3" required></textarea>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblContent">Nội dung</span>
                <textarea class="form-control" name="noidung" rows="5" required></textarea>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblAuthorId">Tác giả</span>
                <select class="form-control" name="ma_tgia" required>
                    <option value="" disabled selected>Chọn tác giả</option>
                    <?php foreach ($authors as $author) { ?>
                        <option value="<?= $author->getMaTgia() ?>"><?= $author->getTenTgia() ?> </option>";
                    <?php } ?>
                </select></div>
            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblImage">Hình ảnh</span>
                <input type="file" class="form-control" name="hinhanh" id="fileInput" accept="image/*" required>
            </div>

            <div class="mt-3 mb-3">
                <img id="imagePreview" src="#" alt="Preview Image" style="display:none; max-width: 200px;">
            </div>
            <div class="form-group float-end">
                <input type="submit" value="Thêm" class="btn btn-success">
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
<footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2"
        style="height:80px">
    <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>