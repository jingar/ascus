<?php

require_once './Database.php';
if (isset($_POST['email'])) {
    $value = $_POST['email'];
    try {
        $connection = new Database('read');
        $conn = $connection->connect();
        $statement = $conn->prepare("SELECT `email` from `members` WHERE `email` = :email");
        $statement->bindParam(':email', $value, PDO::PARAM_STR);
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