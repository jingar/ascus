<?php

require_once './Database.php';
if (isset($_POST['username'])) {
    $value = $_POST['username'];
    try {
        $connection = new Database('read');
        $conn = $connection->connect();
        $statement = $conn->prepare("SELECT `username` from `members` WHERE `username` = :username");
        $statement->bindParam(':username', $value, PDO::PARAM_STR);
        $execute = $statement->execute();
        if ($statement->fetchColumn()) {
            echo "false";
            return;
        }
        echo "true";
        return;
    } catch (Exception $ex) {
        echo "fail";
    }
} else {
    echo "false";
    return;
}