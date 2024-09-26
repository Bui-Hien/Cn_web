<?php

use connection\Database;
use models\Author;

class AuthorService
{
    public function getAllAuthors()
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            $sql = "SELECT * FROM `tacgia`";

            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $authors = array();
            while (($row = $stmt->fetch())) {
                $author = new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
                array_push($authors, $author);
            }
            return $authors;
        } else {
            return $authors = [];
        }
    }

    public function save(Author $author)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            try {
                $sql = "INSERT INTO tacgia (ten_tgia, hinh_tgia)
                        VALUES (:ten_tgia, :hinh_tgia)";

                $stmt = $conn->prepare($sql);

                $ten_tgia = $author->getTenTgia();
                $hinh_tgia = $author->getHinhTgia();
                $stmt->bindParam(':ten_tgia', $ten_tgia, PDO::PARAM_STR);
                $stmt->bindParam(':hinh_tgia', $hinh_tgia, PDO::PARAM_STR);
                $stmt->execute();
                return $author;
            } catch (PDOException $e) {
                error_log("Error inserting category: " . $e->getMessage());
                return null;
            }
        } else {
            return null;
        }
    }

    public function getAuthor($id)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            $sql = "SELECT * FROM `tacgia` WHERE ma_tgia = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Thực thi câu truy vấn
            $stmt->execute();

            // Lấy kết quả truy vấn
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Nếu tìm thấy kết quả
            if ($row) {
                return new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
            } else {
                return null;  // Trường hợp không tìm thấy thể loại với id
            }
        } else {
            return null;  // Trường hợp không kết nối được với database
        }
    }

    public function update(Author $author)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            try {
                $sql = "UPDATE tacgia SET ten_tgia = :ten_tgia";

                // Kiểm tra nếu có ảnh mới, thì cập nhật
                $hinhanh = $author->getHinhTgia();
                if (!empty($hinhanh)) {
                    $sql .= ", hinh_tgia = :hinhanh";
                }
                $sql .= " WHERE ma_tgia = :id";

                $stmt = $conn->prepare($sql);

                // Bind các giá trị
                $tenTgia = $author->getTenTgia();
                $stmt->bindParam(':ten_tgia', $tenTgia, PDO::PARAM_STR);

                // Nếu có ảnh mới thì bindParam cho hình ảnh
                if (!empty($hinhanh)) {
                    $stmt->bindParam(':hinhanh', $hinhanh, PDO::PARAM_STR);
                }

                // Bind ID tác giả để update đúng bản ghi
                $maTgia = $author->getMaTgia();
                $stmt->bindParam(':id', $maTgia, PDO::PARAM_INT);

                $stmt->execute();
                return $author;

            } catch (PDOException $e) {
                echo $e;
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
                $sql = "DELETE FROM tacgia WHERE ma_tgia = :id";
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

    public function countAuthors()
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            $sql = "SELECT COUNT(*) AS total_authors FROM tacgia";

            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $row = $stmt->fetch();
            return $row['total_authors'];
        } else {
            return 0;
        }
    }

}