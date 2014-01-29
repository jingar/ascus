<?php
require_once './php/Database.php';
$output = "A confirmation email has been sent";
if (isset($_GET['confirmation_key'])) {
    try {
        $confirmation_key = $_GET['confirmation_key'];
        $database = new Database("write");
        $database_connection = $database->connect();
        $query = "UPDATE `members` SET `status` = :new_status WHERE `confirmation_key`"
                . "= :confirmation_key";
        $prepared_statement = $database_connection->prepare($query);
        $status = 1;
        $prepared_statement->bindParam(":confirmation_key", $confirmation_key, PDO::PARAM_STR);
        $prepared_statement->bindParam(":new_status", $status, PDO::PARAM_INT);
        $prepared_statement->execute();
        $output = "Email confirmed you can log in now";
    } catch (Exception $ex) {
        $output = "Could not confirm email" . PHP_EOL;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Confirmation</title>
        <?php require_once('./php/css-js-inc.php'); ?>
    </head>
    <?php require_once('./php/header-inc.php'); ?>
    <body>
        <div class="center box">
            <h3><?php echo $output; ?></h3>
        </div>
    </body>
</html>