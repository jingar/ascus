<?php

require_once 'Member.php';
require_once 'Database.php';
require_once 'Mailer.php';
try {
    $connection = new Database("write");
    $conn = $connection->connect();
    $member = new Member($conn);
    $member->register($name, $email, $username, $password);
    echo 'REGISTER_INC_PDO';
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>