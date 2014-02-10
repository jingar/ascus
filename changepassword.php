<?php
require_once 'core/init.php';
$error_html = NULL;
$member = new Member();
if(!$member->isLoggedIn()){
    Redirect::to('homepage.php');
}
if(Input::exists()) {
    if(Token::check(Input::get('csrf_token')))
    {
        try
        {
            $hashed_password = Hash::generate(Input::get('newPassword'));

            $validatorManager = new ValidatorManager();
            $validatorManager->addValidator(new RequiredValidator())
            ->addValidator(new MinimumLengthValidator(5))
            ->addValidator(new EqualValidator($member->getData()->password,'Current Password'));
            $validatorManager->validate(Hash::generate(Input::get('oldPassword')), "Original Password");
            echo $member->getData()->password. "</br>";
            echo Hash::generate(Input::get('oldPassword'));

            $validatorManager->addValidator(new RequiredValidator())
            ->addValidator(new MinimumLengthValidator(5));
            $validatorManager->validate(Input::get('newPassword'), "New Password");

            $validatorManager->addValidator(new RequiredValidator())
            ->addValidator(new EqualValidator(Input::get('newPassword'), 'New Password'));
            $validatorManager->validate(Input::get('confirmPassword'), "Confirm Password");

            if (empty($validatorManager->getErrors())) {

            } else {
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
        }catch (Exception $ex) {
            echo $ex;
        }
    }
    else
    {
        echo 'incorrect token';
    }
}
?>
<!DOCTYPE html >
<html lang="en">
    <head>
        <title>Change Profile</title>
        <meta charset="UTF-8">
        <?php require_once('./classes/css-js-inc.php'); ?>
        <link rel="stylesheet" href="css/jquery.tagit.css" type="text/css">
        <link rel="stylesheet" href="css/tagit.ui-zendesk.css" type="text/css">
        <script type="text/javascript" src="js/AddTags.js"></script>
    </head>
    <?php require_once('./classes/header-inc.php'); ?>
    <body>
        <div class="container">
            <div class ="box">
                <fieldset class="push-down-further">
                    <legend>Change Password</legend>
                </fieldset>
                <?php echo $error_html ?>
                <form id="registration_form" class="push-down" role="form" method ="POST" action ="">
                    <div class="form-group">
                        <label for="originalPassword">Original Password</label>
                        <input name="originalPassword" type="password" class="form-control" id="originalPassword" placeholder="Original Password">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Passowrd</label>
                        <input name="newPassword" type="password" class="form-control" id="newPassword" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Passowrd</label>
                        <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>"
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-4">
                            <button name="register" id = "register" type="submit" class="btn btn-default grey-background">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </body>
</html>