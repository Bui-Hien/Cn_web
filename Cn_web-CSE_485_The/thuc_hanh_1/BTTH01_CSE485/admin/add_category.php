<?php
include 'header.php';
?>
<!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
<div class="row">
    <div class="col-sm">
        <h3 class="text-center text-uppercase fw-bold">Thêm mới thể loại</h3>
        <form action="process_add_category.php" method="post">
            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                <input type="text" class="form-control" name="txtCatName">
            </div>

            <div class="form-group  float-end ">
                <input type="submit" value="Thêm" class="btn btn-success">
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