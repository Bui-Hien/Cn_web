<?php

class HomeController
{
    public function index()
    {
        $service = new ArticleService();
        $articles = $service->getAllArticles();
        include("./views/home/index.php");
    }

    public function show()
    {
        if (!empty($_GET['id'])) {
            $service = new ArticleService();
            $id = $_GET['id'];
            $article = $service->getAllArticle($id);
            include("./views/home/show.php");
        } else {
            echo "Không tồn tại bài viết.";
        }

    }

    public function showLogin()
    {
        include("./views/home/login.php");
    }
}