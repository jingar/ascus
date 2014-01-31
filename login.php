<?php
session_start();
ob_start();
$redirect = './homepage.php';
if (!empty($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header("Location: $redirect");
} elseif (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    require_once('./php/authenticate-pdo-inc.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <?php require_once('./php/css-js-inc.php'); ?>
        <script type="text/javascript" src="js/login-validation.js"></script>
    </head>
    <?php require_once('./php/header-inc.php'); ?>
    <body>
        <?php
        if ($error) {
            echo '<div class="container form-group has-error push-down">';
            echo "<label class=control-label for=inputError><p>$error</p></label>";
            echo "</div>";
        } elseif (isset($_GET['expired'])) {
            ?>
            <div class="container form-group has-error">
                <label class=control-label for=inputError>Your session has expired. Please log in again.</label>
            </div>
        <?php } ?>
        <div class="container push-down-further">
            <div class="box"> 
                <form id="login_form" class="form-horizontal push-down" role="form" method ="post" action ="">
                    <div class="form-group">
                        <label for="Username" class="col-md-2 control-label">Username</label>
                        <div class="col-md-8">
                            <input name="username" type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-2 control-label">Password</label>
                        <div class="col-md-8">
                            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button name="login" id="login" type="submit" class="btn btn-default">Log in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>