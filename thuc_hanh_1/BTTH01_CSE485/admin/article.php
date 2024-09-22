<?php
global $pdo;
include '../config/connect.php';
$sql_articles = "SELECT *, tacgia.ten_tgia, theloai.ten_tloai FROM `baiviet`
	JOIN tacgia ON tacgia.ma_tgia = baiviet.ma_tgia
    JOIN theloai ON theloai.ma_tloai= baiviet.ma_tloai";
$stmt_articles = $pdo->query($sql_articles);
$articles = $stmt_articles->fetchAll();
include 'header.php';

?>
<!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
<div class="row">
    <div class="col-sm">
        <a href="add_article.php" class="btn btn-success">Thêm mới</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Tên bài hát</th>
                <th scope="col">Tóm tắt</th>
                <th scope="col">Nội dung bài viết</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col"> Hình ảnh</th>
                <th scope="col">Tác giả</th>
                <th scope="col">Thể loại</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <th scope="row"><?= $article['ma_bviet'] ?></th>
                    <td><?= $article['tieude'] ?></td>
                    <td><?= $article['ten_bhat'] ?></td>
                    <td><?= $article['tomtat'] ?></td>
                    <td><?= $article['noidung'] ?></td>
                    <td><?= $article['ngayviet'] ?></td>
                    <td>
                        <?php if (!empty($article['hinhanh'])): ?>
                            <img src="../uploads/<?= htmlspecialchars($article['hinhanh']) ?>"
                                 alt="Hình ảnh bài viết" style="width: 100px; height: auto;">
                        <?php else: ?>
                            Không có hình ảnh
                        <?php endif; ?></td>
                    <td><?= $article['ten_tgia'] ?></td>
                    <td><?= $article['ten_tloai'] ?></td>

                    <td>
                        <a href="edit_article.php?id=<?= $article['ma_bviet'] ?>"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    <td>
                        <form action="process_delete_article.php" method="post" onsubmit="return confirmDelete()">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($article['ma_bviet']) ?>"/>
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