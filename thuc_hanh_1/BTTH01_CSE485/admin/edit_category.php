<?php
global $pdo;
include '../config/connect.php'; // Đảm bảo đường dẫn đúng

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Chuyển đổi ID sang kiểu số nguyên để bảo mật

    // Xác nhận ID hợp lệ
    if ($id > 0) {
        try {
            // Chuẩn bị câu lệnh SQL để lấy thông tin thể loại
            $sql_categories = "SELECT * FROM theloai WHERE ma_tloai = :id";
            $stmt_categories = $pdo->prepare($sql_categories);
            $stmt_categories->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_categories->execute();

            // Lấy dữ liệu và in ra
            $category = $stmt_categories->fetch();

            if (empty($category)) {
                echo '<p>Không tìm thấy thể loại với ID này.</p>';
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

    <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Sửa thông tin thể loại</h3>
            <form action="process_edit_category.php" method="post">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId">Mã thể loại</span>
                    <input type="text" class="form-control" name="txtCatId" readonly
                           value="<?= $category['ma_tloai'] ?>">
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                    <input type="text" class="form-control" name="txtCatName" value="<?= $category['ten_tloai'] ?>">
                </div>

                <div class="form-group  float-end ">
                    <input type="submit" value="Lưu lại" class="btn btn-success">
                    <a href="category.php" class="btn btn-warning ">Quay lại</a>
                </div>
            </form>
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
