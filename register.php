<?php
if (isset($_POST['register'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $phone_number = trim($_POST['phone_number']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $redirect = './profile.php';
    require_once('./php/register-inc-pdo.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
        <?php require_once('./php/css-js-inc.php'); ?>
        <script type="text/javascript" src="js/add-skills-to-form.js"></script>
        <script type="text/javascript" src="js/add-interests-to-form.js"></script>
    </head>
    <?php require_once('./php/header-inc.php'); ?>
    <?php
    if (isset($success)) {
        echo '<div class="container form-grsoup has-success">';
        echo "<ul><li><label class=control-label for=inputSuccess>$success</label></li></ul>";
        echo '</div>';
    } elseif (isset($errors) && !empty($errors)) {
        echo '<div class="container form-group has-error">';
        echo '<ul>';
        foreach ($errors as $error) {
            echo "<li><label class=control-label for=inputError>" . $error . "</li></label>";
        }
        echo '</ul>';
        echo '</div>';
    }
    ?>
    <body>
        <div class="container">
            <fieldset class="push-down-further">
                <legend> Registration </legend>
            </fieldset>
            <form id="registration_form" class="form-horizontal push-down" role="form" method ="post" action ="">
                <div class="form-group">
                    <label for="name" class="col-md-2 control-label">Name</label>
                    <div class="col-md-4">
                        <input name="name" type="text" class="form-control" id="name" placeholder="First Name">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="col-md-2 control-label">Email</label>
                    <div class="col-md-4">
                        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-md-2 control-label">Username</label>
                    <div class="col-md-4">
                        <input name="username" type="text" class="form-control" id="username" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-2 control-label">Password</label>
                    <div class="col-md-4">
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="col-md-2 control-label">Confirm Password</label>
                    <div class="col-md-4">
                        <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-4">
                        <button name="register" id = "register" type="submit" class="btn btn-default grey-background">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>