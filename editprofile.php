<?php
require_once 'core/init.php';
$member = new Member();

if(!$member->isLoggedIn()){
    Redirect::to('homepage.php');
}
if (Input::exists()) {
    if(Token::check(Input::get('token')))
    {
        $member->editProfile(array(
            'name' => Input::get('name'),
            'city' => Input::get('city'),
            'country' => Input::get('country')
            ));
    }
}
?>
<!DOCTYPE html >
<html lang="en">
    <head>
        <title>Edit Profile</title>
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
                    <legend>Edit Profile</legend>
                </fieldset>
                <form id="registration_form" class="push-down" role="form" method ="POST" action ="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?php echo Sanitize::escape($member->getData()->name); ?>">
                    </div>
                    <div class="form-group">
                        <label>Expertise</label>
                        <ul class="form-control tagit ui-widget ui-widget-content ui-corner-all" id="tags">
                        </ul> 
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input name="city" type="text" class="form-control" id="city" placeholder="City">
                    </div>
                    <div class="form-group">
                        <label for="country">City</label>
                        <input name="country" type="text" class="form-control" id="country" placeholder="Country">
                    </div>
                    <div class="form-group">
                        <lable for="bio">Bio</lable>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
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