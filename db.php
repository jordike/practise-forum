<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=test_forum", "root", "");
    } catch (PDOException $exception) {
        die($exception->getMessage());
    }

    function username_exists($username) {
        global $db;

        $query = $db->prepare("SELECT username FROM accounts WHERE username = :username");
        $query->bindParam("username", $username);

        if (!$query->execute()) {
            return true;
        }

        return $query->rowCount() != 0;
    }
?>
