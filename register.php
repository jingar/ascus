<?php

require_once './core/init.php';
$error_html = NULL;
if (Input::exists()) {
    if (Token::check(Input::get('csrf_token')) === FALSE) {
        Redirect::to(404);
    }
    try {
        $hashed_password = Hash::generate(Input::get('password'));
        $confirmation_key = Hash::generateUniqueNumber();

        $validatorManager = new ValidatorManager();
        $validatorManager->addValidator(new RequiredValidator());
        $validatorManager->validate(Input::get('name'), "Name");

        $validatorManager->addValidator(new RequiredValidator())
                ->addValidator(new EmailValidator())
                ->addValidator(new UniqueValidator('email'));
        $validatorManager->validate(Input::get('email'), "Email");

        $validatorManager->addValidator(new RequiredValidator())
                ->addValidator(new MinimumLengthValidator(5))
                ->addValidator(new UniqueValidator('username'));
        $validatorManager->validate(Input::get('username'), "Username");

        $validatorManager->addValidator(new RequiredValidator(''))
                ->addValidator(new MinimumLengthValidator(5));
        $validatorManager->validate(Input::get('password'), "Password");

        $validatorManager->addValidator(new RequiredValidator())
                ->addValidator(new EqualValidator(Input::get('password'), 'Password'));
        $validatorManager->validate(Input::get('confirmPassword'), "Confirm Password");

        if (empty($validatorManager->getErrors())) {
            $member = new Member();
            $member->register(array(Input::get('name'), Input::get('profession'), Input::get('email'),
                Input::get('username'), $hashed_password, NULL, NULL, $confirmation_key, 0, NULL));
            Mailer::send_mail(Input::get('name'), Input::get('email'), $confirmation_key);
            Session::flash('Success Registered', 'Registered sucessfully but you must activate your account before logging in');
            Redirect::to('homepage.php');
        } else {
            Redirect::to(404);
            $error_html.="<div id =\"error-explanation\">";
            $error_html.="<div class=\"alert alert-danger\">";
            $error_html.="<ul>";
            foreach ($validatorManager->getErrors() as $error) {
                $error_html.= "<li> $error </li>";
            }
            $error_html.= "</ul>";
            $error_html.= "</div>";
            $error_html.= "</div>";
        }
    } catch (Exception $ex) {
        echo $ex;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title>
        <?php require_once('./classes/css-js-inc.php'); ?>
        <script type="text/javascript" src="js/registeration-validation.js"></script>
    </head>
    <?php require_once('./classes/header-inc.php'); ?>
    <body>
        <div class="container">
            <div class="box">
                <fieldset class="push-down-further">
                    <legend> Registration </legend>
                </fieldset>
                <?php echo $error_html ?>
                <form id = "registration_form" class = "form-horizontal push-down" role = "form" method = "POST" action = "">
                    <div class = "form-group">
                        <label for = "name">Name</label>
                        <div>
                            <input name = "name" type = "text" class = "form-control" id = "name" placeholder = "First Name">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for = "profession">Profession</label>
                        <select name = "profession" class = "form-control" id = "profession">
                            <option value = "artist">Artist</option>
                            <option value = "scientist">Scientist</option>
                        </select>
                    </div>
                    <div class = "form-group">
                        <label for = "email">Email</label>
                        <div>
                            <input name = "email" type = "email" class = "form-control" id = "email" placeholder = "Email">
                        </div>
                    </div>

                    <div class = "form-group">
                        <label for = "username">Username</label>
                        <div>
                            <input name = "username" type = "text" class = "form-control" id = "username" placeholder = "Username">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for = "password">Password</label>
                        <div>
                            <input name = "password" type = "password" class = "form-control" id = "password" placeholder = "Password">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for = "confirmPassword">Confirm Password</label>
                        <div>
                            <input name = "confirmPassword" type = "password" class = "form-control" id = "confirmPassword" placeholder = "Confirm Password">
                        </div>
                    </div>

                    <input type="hidden" name="csrf_token" value="<?php Token::generate(); ?>"
                    <div class = "form-group">
                        <div class = "col-md-offset-2 col-md-4">
                            <button name = "register" id = "register" type = "submit" class = "btn btn-default grey-background">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>