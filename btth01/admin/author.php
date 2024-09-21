<?php
global $pdo;
include '../config/connect.php';
$sql_authors = "SELECT * FROM `tacgia`";
$stmt_authors = $pdo->query($sql_authors);
$authors = $stmt_authors->fetchAll();
include 'header.php';

?>

<!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
<div class="row">
    <div class="col-sm">
        <a href="add_author.php" class="btn btn-success">Thêm mới</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Mã Tác Giả</th>
                <th scope="col">Tên Tác Giả</th>
                <th scope="col">Hình Ảnh</th>
                <th scope="col">Chỉnh Sửa</th>
                <th scope="col">Xóa</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($authors as $author) { ?>
                <tr>
                    <th scope="row"><?= $author['ma_tgia'] ?></th>
                    <td><?= $author['ten_tgia'] ?></td>
                    <td>
                        <?php if (!empty($author['hinh_tgia'])): ?>
                            <img src="../uploads/<?= htmlspecialchars($author['hinh_tgia']) ?>"
                                 alt="Hình ảnh tác giả" style="width: 100px; height: auto;">
                        <?php else: ?>
                            Không có hình ảnh
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_author.php?id=<?= $author['ma_tgia'] ?>"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    <td>
                        <form action="process_delete_author.php" method="post" onsubmit="return confirmDelete()">
                            <input type="hidden" name="id" value="<?= $author['ma_tgia'] ?>"/>
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