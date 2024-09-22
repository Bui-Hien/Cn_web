<?php
global $pdo;
include '../config/connect.php'; // Đảm bảo đường dẫn đúng

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Chuyển đổi ID sang kiểu số nguyên để bảo mật

    // Xác nhận ID hợp lệ
    if ($id > 0) {
        try {
            // Chuẩn bị câu lệnh SQL để lấy thông tin tác giả
            $sql_author = "SELECT * FROM `tacgia` WHERE ma_tgia = :id";
            $stmt_author = $pdo->prepare($sql_author);
            $stmt_author->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_author->execute();
            $author = $stmt_author->fetch();

            if (empty($author)) {
                echo '<p>Không tìm thấy tác giả với ID này.</p>';
                exit();
            }

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
        <h3 class="text-center text-uppercase fw-bold">Chỉnh sửa tác giả</h3>
        <form action="process_edit_author.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="ma_tgia" value="<?= htmlspecialchars($author['ma_tgia']) ?>">

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblAuthorName">Tên tác giả</span>
                <input type="text" class="form-control" name="ten_tgia" id="ten_tgia"
                       value="<?= htmlspecialchars($author['ten_tgia']) ?>" required>
            </div>
            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblImage">Hình ảnh</span>
                <input type="file" class="form-control" name="hinhanh" id="fileInput" accept="image/*">
            </div>

            <div class="mt-3 mb-3">
                <?php if (!empty($author['hinh_tgia'])): ?>
                    <img id="imagePreview" src="../uploads/<?= htmlspecialchars($author['hinh_tgia']) ?>"
                         alt="Preview Image" style="max-width: 200px;">
                <?php else: ?>
                    <img id="imagePreview" src="#" alt="Preview Image" style="display:none; max-width: 200px;">
                <?php endif; ?>
            </div>

            <div class="form-group float-end">
                <input type="submit" value="Lưu lại" class="btn btn-success">
                <a href="author.php" class="btn btn-warning">Quay lại</a>
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
