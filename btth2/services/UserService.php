<?php


use connection\Database;

class UserService
{
    public function countUsers()
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            $sql = "SELECT COUNT(*) AS total_users FROM users";

            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $row = $stmt->fetch();
            return $row['total_users'];
        } else {
            return 0;
        }
    }

    public function getUser($username, $password)
    {
        $database = new Database();
        $conn = $database->getConnect();

        if ($conn !== null) {
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && $password == $row['password']) {
                session_start();
                $_SESSION['logged_in'] = true;
                return true;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}