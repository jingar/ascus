<?php
require_once './core/init.php';

if (Session::exists('Login Success')) {
    echo "<div class=\"alert alert-success\">" . Session::flash('Login Success') . "</div>";
}
else if (Session::exists('Login Failure')) {
    echo "<div class=\"alert alert-danger\">" . Session::flash('Login Failure') . "</div>";
} 
else if (Session::exists('Email Failure')) {
    echo "<div class=\"alert alert-danger\">" . Session::flash('Email Failure') . "</div>";
}

if (Input::exists()) {
    if (Token::check(Input::get('token') === FALSE)) {
        Redirect::to(404);
    }
    $validatorManager = new ValidatorManager();
    $validatorManager->addValidator(new RequiredValidator());
    $validatorManager->validate(Input::get('username'), 'Username');

    $validatorManager->addValidator(new RequiredValidator());
    $validatorManager->validate(Input::get('password'), 'Password');

    if (empty($validatorManager->getErrors())) {
        $member = new Member();
        if ($member->login(Input::get('username'), Input::get('password'))) {
            if ($member->isAccountActivated(Input::get('username'))) {   
                Session::put(Config::get('session/session_name'), $member->findByUsername(
                    Input::get('username'))->members_id);
                Session::put("time", time());
                session_regenerate_id();
                Session::flash("Login Success", "Logged in");
                Redirect::to('homepage.php');
            } else {
                Session::flash("Email Failure", "Email not activiated");
                var_dump($member->isAccountActivated(Input::get('username')));
                Redirect::to('login.php');   
            }
        }
        else
        {
            Session::flash("Login Failure", "Username and password combiniation does not match");
                Redirect::to('login.php');
        }
    } else {
        var_dump($validatorManager->getErrors());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/strapped.css">
    </head>
    <?php require_once('./classes/header-inc.php'); ?>
    <body>
        <div class="container login">
            <div box> 
                <form id="login_form" class="form-horizontal push-down" role="form" method ="post" action ="">
                    <fieldset>
                    <legend>Login</legend>
                    </fieldset>
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
                    <input type="hidden" name="token" value="<?php Token::generate(); ?>">
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button name="login" id="login" type="submit" class="btn btn-warning">Log in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once 'includes/footer.php' ?>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/login-validation.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>