<?php

class AuthController
{
    public function homeAdmin()
    {
        $userService = new UserService();
        $authorService = new AuthorService();
        $articleService = new ArticleService();
        $categoryService = new CategoryService();
        $total_users = $userService->countUsers();
        $total_categories = $categoryService->countCategories();
        $total_authors = $authorService->countAuthors();
        $total_posts = $articleService->countArticles();
        include './views/admin/index.php';
    }

    public
    function login()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) && !empty($password)) {
            // Chuẩn bị câu lệnh SQL
            $service = new UserService();
            // Kiểm tra nếu có kết quả
            if ($service->getUser($username, $password) == true) {
                // Lưu tên người dùng vào session
                header('Location: /btth02v2/index.php?controller=Auth&action=homeAdmin');
                exit();
            } else {
                echo "Tên người dùng hoặc mật khẩu không chính xác.";
            }
        } else {
            echo "Vui lòng nhập đầy đủ thông tin.";
        }
    }

    public
    function logout()
    {

        session_start();
        session_unset();
        session_destroy();
        // Redirect to login page
        header('Location: /btth02v2/index.php?controller=Home&action=showLogin');
        exit();
    }

}