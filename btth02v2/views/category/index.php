<?php
include_once "./views/layout/header.php";

use models\Category;

if (empty($categories)) {
    $categories = array(new Category());
}
?>
<div class="row mt-5">
    <div class="col-sm">
        <a href="<?= textdomain("/btth02v2/index.php?controller=Category&action=create") ?>" class="btn btn-success">Thêm
            mới</a>
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
            <?php foreach ($categories as $index => $category) { ?>
                <tr>
                    <th scope="row"><?= $index ?></th>
                    <td><?= $category->getTenTloai() ?></td>
                    <td>
                        <a href="<?= textdomain("/btth02v2/index.php?controller=Category&action=edit&id=" . $category->getMaTloai()) ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <form action="<?= textdomain("/btth02v2/index.php?controller=Category&action=delete") ?>"
                              method="post" onsubmit="return confirmDelete()">
                            <input type="hidden" name="id" value="<?= $category->getMaTloai() ?>"/>
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