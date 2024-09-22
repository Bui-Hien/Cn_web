<?php
global $pdo;
include '../config/connect.php';
$sql_categories = "SELECT * FROM theloai";
$stmt_categories = $pdo->query($sql_categories);
$categories = $stmt_categories->fetchAll();
include 'header.php';

?>
    <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
    <div class="row">
        <div class="col-sm">
            <a href="add_category.php" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên thể loại</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category) { ?>
                    <tr>
                        <th scope="row"><?= $category['ma_tloai'] ?></th>
                        <td><?= $category['ten_tloai'] ?></td>
                        <td>
                            <a href="edit_category.php?id=<?= $category['ma_tloai'] ?>"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <form action="process_delete_category.php" method="post" onsubmit="return confirmDelete()">
                                <input type="hidden" name="id" value="<?= $category['ma_tloai'] ?>"/>
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2"
        style="height:80px">
    <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
</footer>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>