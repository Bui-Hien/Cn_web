<?php
include_once "./views/layout/header.php";

use models\Article;

if (empty($articles))
    $articles = array(new Article);
?>

    <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
    <div class="row">
        <div class="col-sm">
            <a href="<?= textdomain("/btth02v2/index.php?controller=Article&action=create") ?>" class="btn btn-success">Thêm
                mới</a>
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
                <?php foreach ($articles as $index => $article) { ?>
                    <tr>
                        <th scope="row"><?= $index ?></th>
                        <td><?php echo htmlspecialchars($article->getTieude()); ?></td>
                        <td><?php echo htmlspecialchars($article->getTenBhat()); ?></td>
                        <td><?php echo htmlspecialchars($article->getTomtat()); ?></td>
                        <td><?php echo htmlspecialchars($article->getNoidung()); ?></td>
                        <td><?php echo htmlspecialchars($article->getNgayviet()); ?></td>
                        <td><img src="http://localhost/btth02v2/uploads/<?= $article->getHinhanh(); ?>"
                                 alt="" style="width: 100px; height: auto"></td>

                        <td><?php echo htmlspecialchars($article->getTacGia()->getTenTgia()); ?></td>
                        <td><?php echo htmlspecialchars($article->getTheLoai()->getTenTloai()); ?></td>

                        <td>
                            <a href="<?= textdomain("/btth02v2/index.php?controller=Article&action=edit&id=" . $article->getMaBviet()) ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                        </td>
                        <td>
                            <form action="<?= textdomain("/btth02v2/index.php?controller=Article&action=delete") ?>"
                                  method="post" onsubmit="return confirmDelete()">
                                <input type="hidden" name="id" value="<?= $article->getMaBviet() ?>"/>
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