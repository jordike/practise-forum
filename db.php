<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=test_forum", "root", "");
    } catch (PDOException $exception) {
        die($exception->getMessage());
    }
?>
