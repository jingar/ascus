<?php

require_once('Member.php');
require_once('Database.php');
try {
    $database = new Database('read');
    $member = new Member($database->connect());
    if (!$member->isAccountActivated($_POST['username'])) {
        $error = "Email address for this account has not been confirmed, please check your emails";
    } else if ($member->login($_POST['username'], $_POST['password'])) {
        header("Location: $redirect");
    } else {
        $error = "Username and Password combination do not match";
    }
} catch (Exception $ex) {
    echo $ex . ":authenticate-pdo-inc.php";
}
?>