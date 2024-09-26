<?php

use connection\Database;
use models\Category;

class CategoryService
{
    public function getAllCategories()
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            $sql = "SELECT * FROM `theloai`";

            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $categories = array();
            while (($row = $stmt->fetch())) {
                $categorie = new Category($row['ma_tloai'], $row['ten_tloai']);
                array_push($categories, $categorie);
            }
            return $categories;
        } else {
            return $categories = [];
        }
    }

    public function save(Category $category)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            try {
                $sql = "INSERT INTO theloai (ten_tloai) VALUES (:ten_tloai)";

                $stmt = $conn->prepare($sql);

                $ten_tloai = $category->getTenTloai();
                $stmt->bindParam(':ten_tloai', $ten_tloai, PDO::PARAM_STR);
                $stmt->execute();
                return $category;
            } catch (PDOException $e) {
                error_log("Error inserting category: " . $e->getMessage());
                return null;
            }
        } else {
            return null;
        }
    }


    public function getCategory($id)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            $sql = "SELECT * FROM theloai WHERE ma_tloai = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Thực thi câu truy vấn
            $stmt->execute();

            // Lấy kết quả truy vấn
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Nếu tìm thấy kết quả
            if ($row) {
                return new Category($row['ma_tloai'], $row['ten_tloai']);
            } else {
                return null;  // Trường hợp không tìm thấy thể loại với id
            }
        } else {
            return null;  // Trường hợp không kết nối được với database
        }
    }

    public function update(Category $category)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            try {
                $sql = "UPDATE theloai SET ten_tloai = :ten_tloai WHERE ma_tloai = :ma_tloai";

                $stmt = $conn->prepare($sql);

                $tenTloai = $category->getTenTloai();
                $stmt->bindParam(':ten_tloai', $tenTloai, PDO::PARAM_STR);
                $maTloai = $category->getMaTloai();
                $stmt->bindParam(':ma_tloai', $maTloai, PDO::PARAM_INT);

                $stmt->execute();
                return $category;

            } catch (PDOException $e) {
                error_log("Error updating article: " . $e->getMessage());
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
                $sql = "DELETE FROM theloai WHERE ma_tloai = :id";
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

    public function countCategories()
{
    $database = new Database();
    $conn = $database->getConnect();

    if ($conn !== null) {
        $sql = "SELECT COUNT(*) AS total_categories FROM theloai";

        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $row = $stmt->fetch();
        return $row['total_categories'];
    } else {
        return 0;
    }
}
}