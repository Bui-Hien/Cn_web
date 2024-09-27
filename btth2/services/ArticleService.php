<?php

use connection\Database;
use models\Article;

class ArticleService
{
    public function getAllArticleWithAuthorWithCategory()
    {
        $database = new Database();
        $conn = $database->getConnect();

        if (!$conn == null) {
            $sql = "SELECT *, tacgia.ten_tgia, tacgia.ma_tgia,theloai.ma_tloai,  theloai.ten_tloai FROM `baiviet`
                JOIN tacgia ON tacgia.ma_tgia = baiviet.ma_tgia
                JOIN theloai ON theloai.ma_tloai= baiviet.ma_tloai";
            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $articles = array();
            while (($row = $stmt->fetch())) {
                $ma_bviet = $row['ma_bviet'];
                $tieude = $row['tieude'];
                $ten_bhat = $row['ten_bhat'];
                $tomtat = $row['tomtat'];
                $noidung = $row['noidung'];
                $ma_tgia = $row['ma_tgia'];
                $ten_tgia = $row['ten_tgia'];
                $hinh_tgia = $row['hinh_tgia'];
                $ma_tloai = $row['ma_tloai'];
                $ten_tloai = $row['ten_tloai'];
                $ngayviet = $row['ngayviet'];
                $hinhanh = $row['hinhanh'];
                $article = new Article(
                    $ma_bviet,
                    $tieude,
                    $ten_bhat,
                    $tomtat,
                    $noidung,
                    $ma_tgia,
                    $ten_tgia,
                    $hinh_tgia,
                    $ma_tloai,
                    $ten_tloai,
                    $ngayviet,
                    $hinhanh);
                array_push($articles, $article);
            }
            return $articles;
        } else {
            return $patient = [];
        }
    }

    public function getAllArticles()
    {
        $database = new Database();
        $conn = $database->getConnect();

        if (!$conn == null) {
            $sql = "SELECT * FROM `baiviet`";
            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $articles = array();
            while (($row = $stmt->fetch())) {
                $ma_bviet = $row['ma_bviet'];
                $tieude = $row['tieude'];
                $ten_bhat = $row['ten_bhat'];
                $tomtat = $row['tomtat'];
                $noidung = $row['noidung'];
                $ngayviet = $row['ngayviet'];
                $hinhanh = $row['hinhanh'];
                $article = new Article(
                    $ma_bviet,
                    $tieude,
                    $ten_bhat,
                    $tomtat,
                    $noidung,
                    "",
                    "",
                    "",
                    "",
                    "",
                    $ngayviet,
                    $hinhanh);
                array_push($articles, $article);
            }
            return $articles;
        } else {
            return $patient = [];
        }
    }

    public function getAllArticle($id)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            $sql = "SELECT *, tacgia.ten_tgia, theloai.ten_tloai FROM baiviet
                JOIN tacgia ON tacgia.ma_tgia = baiviet.ma_tgia
                JOIN theloai ON theloai.ma_tloai = baiviet.ma_tloai
                WHERE ma_bviet = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the ID parameter

            $stmt->execute();

            // Fetch the article data
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Assign values from the row to variables
                $ma_bviet = $row['ma_bviet'];
                $tieude = $row['tieude'];
                $ten_bhat = $row['ten_bhat'];
                $tomtat = $row['tomtat'];
                $noidung = $row['noidung'];
                $ma_tgia = $row['ma_tgia'];
                $ten_tgia = $row['ten_tgia'];
                $hinh_tgia = $row['hinh_tgia'];
                $ma_tloai = $row['ma_tloai'];
                $ten_tloai = $row['ten_tloai'];
                $ngayviet = $row['ngayviet'];
                $hinhanh = $row['hinhanh'];

                // Create an Article object
                $article = new Article(
                    $ma_bviet,
                    $tieude,
                    $ten_bhat,
                    $tomtat,
                    $noidung,
                    $ma_tgia,
                    $ten_tgia,
                    $hinh_tgia,
                    $ma_tloai,
                    $ten_tloai,
                    $ngayviet,
                    $hinhanh
                );
                return $article; // Return the single article object
            } else {
                return null; // Return null if no article was found
            }
        } else {
            return null; // Return null if the connection failed
        }
    }

    public function store(Article $article)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            try {
                $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh)
                    VALUES (:tieude, :ten_bhat, :ma_tloai, :tomtat, :noidung, :ma_tgia, :ngayviet, :hinhanh)";

                $stmt = $conn->prepare($sql);
                $tieude = $article->getTieude();
                $stmt->bindParam(':tieude', $tieude, PDO::PARAM_STR);

                $ten_bhat = $article->getTenBhat();
                $stmt->bindParam(':ten_bhat', $ten_bhat, PDO::PARAM_STR);

                $ma_tloai = $article->getTheLoai()->getMaTloai();
                $stmt->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);

                $tomtat = $article->getTomtat();
                $stmt->bindParam(':tomtat', $tomtat, PDO::PARAM_STR);

                $noidung = $article->getNoidung();
                $stmt->bindParam(':noidung', $noidung, PDO::PARAM_STR);

                $ma_tgia = $article->getTacGia()->getMaTgia();
                $stmt->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);

                $ngayviet = $article->getNgayviet();
                $stmt->bindParam(':ngayviet', $ngayviet, PDO::PARAM_STR);

                $hinhanh = $article->getHinhanh();
                $stmt->bindParam(':hinhanh', $hinhanh, PDO::PARAM_STR);
                $stmt->execute();
                return $article;
            } catch (PDOException $e) {
                error_log("Error inserting article: " . $e->getMessage());
                return null;
            }
        } else {
            return null;
        }
    }

    public function destroy($id)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            try {
                $sql = "DELETE FROM baiviet WHERE ma_bviet = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                error_log("Error inserting article: " . $e->getMessage());
                return false;
            }
        } else {
            return null;
        }

    }

    public function update(Article $article)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            try {
                $sql = "UPDATE baiviet 
                    SET tieude = :tieude, ten_bhat = :ten_bhat, ma_tloai = :ma_tloai, tomtat = :tomtat, noidung = :noidung, ma_tgia = :ma_tgia, ngayviet = :ngayviet";

                // Kiểm tra nếu có ảnh mới, thì cập nhật
                $hinhanh = $article->getHinhanh();
                if ($hinhanh != "") {
                    $sql .= ", hinhanh = :hinhanh";
                }
                $sql .= " WHERE ma_bviet = :id";

                $stmt = $conn->prepare($sql);

                // Bind các giá trị
                $tieude = $article->getTieude();
                $stmt->bindParam(':tieude', $tieude, PDO::PARAM_STR);
                $tenBhat = $article->getTenBhat();
                $stmt->bindParam(':ten_bhat', $tenBhat, PDO::PARAM_STR);
                $maTloai = $article->getTheLoai()->getMaTloai();
                $stmt->bindParam(':ma_tloai', $maTloai, PDO::PARAM_INT);
                $tomtat = $article->getTomtat();
                $stmt->bindParam(':tomtat', $tomtat, PDO::PARAM_STR);
                $noidung = $article->getNoidung();
                $stmt->bindParam(':noidung', $noidung, PDO::PARAM_STR);
                $maTgia = $article->getTacGia()->getMaTgia();
                $stmt->bindParam(':ma_tgia', $maTgia, PDO::PARAM_INT);
                $ngayviet = $article->getNgayviet();
                $stmt->bindParam(':ngayviet', $ngayviet, PDO::PARAM_STR);

                // Nếu có ảnh mới thì bindParam cho hình ảnh
                if ($hinhanh != "") {
                    $stmt->bindParam(':hinhanh', $hinhanh, PDO::PARAM_STR);
                }

                // Bind ID bài viết để update đúng bài
                $maBviet = $article->getMaBviet();
                $stmt->bindParam(':id', $maBviet, PDO::PARAM_INT);

                $stmt->execute();
                return $article;

            } catch (PDOException $e) {
                error_log("Error updating article: " . $e->getMessage());
                return null;
            }
        } else {
            return null;
        }
    }

    public function countArticles()
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            $sql = "SELECT COUNT(*) AS total_posts FROM baiviet";

            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $row = $stmt->fetch();
            return $row['total_posts'];
        } else {
            return 0;
        }
    }

}
