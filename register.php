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
        <?php require_once('./php/css-js-inc.php'); ?>
        <script>
            $().ready(function() {
                // validate the registration form when it is submitted
                $("#registration_form").validate({
                    rules: {
                        first_name: "required",
                        last_name: "required",
                        username: {
                            required: true,
                            minlength: 5
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                        confirm_password: {
                            required: true,
                            minlength: 5,
                            equalTo: "#password"
                        },
                        email: {
                            email: true
                        }
                    }
                });

            });
        </script>
    </head>
    <?php require_once('./php/header-inc.php'); ?>
    <?php
    if (isset($success)) {
        echo '<div class="container form-group has-success">';
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
        <div class="container center">
            <form id="registration_form" class="form-horizontal push-down-further" role="form" method ="post" action ="">
                <div class="form-group">
                    <label for="first_name" class="col-md-2 control-label">First Name</label>
                    <div class="col-md-4">
                        <input name="first_name" type="text" class="form-control" id="first_name" placeholder="First Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name" class="col-md-2 control-label">Last Name</label>
                    <div class="col-md-8">
                        <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-2 control-label">Email</label>
                    <div class="col-md-8">
                        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="col-md-2 control-label">City</label>
                    <div class="col-md-8">
                        <input name="city" type="text" class="form-control" id="city" placeholder="City">
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="col-md-2 control-label">Country</label>
                    <div class="col-md-8">
                        <input name="country" type="text" class="form-control" id="country" placeholder="Country">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="phone_number" class="col-md-2 control-label">Phone Number</label>
                    <div class="col-md-8">
                        <input name="phone_number" type="text" class="form-control" id="phone_number" placeholder="Phone Number">
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-md-2 control-label">Username</label>
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
                    <label for="confirm_password" class="col-md-2 control-label">Confirm Password</label>
                    <div class="col-md-8">
                        <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button name="register" type="submit" class="btn btn-default">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>