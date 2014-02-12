<?php
require_once 'core/init.php';
$member = new Member();

if(!$member->isLoggedIn()){
    Redirect::to('homepage.php');
}
if($member->getData()->members_id !== Input::get('id'))
{
    Redirect::to(404);
}
if (Input::exists()) {
    if(Token::check(Input::get('csrf_token')))
    {
        try {

            $member->editMember(array(Input::get('name'),Input::get('city'),Input::get('country'),
                Input::get('bio')));

            $expertise = new Expertise();
            $expertise->addExpertise(Input::get('tags'));
        } catch (Exception $e) {
         echo $ex;   
        }

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
                <ul class="nav nav-tabs">
                <li class="active"><a href="#">Edit Profile</a></li>
                  <li><a href="#">Username & Password</a></li>
                  <li><a href="#">Work Samples</a></li>
              </ul>
                <form id="registration_form" class="push-down" role="form" method ="POST" action ="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" 
                        value="<?php echo Sanitize::escape($member->getData()->name); ?>">
                    </div>
                    <div class="form-group">
                        <label>Expertise</label>
                        <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="tags">
                        </ul> 
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input name="city" type="text" class="form-control" id="city" placeholder="City"
                        value="<?php echo Sanitize::escape($member->getData()->city); ?>">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input name="country" type="text" class="form-control" id="country" placeholder="Country"
                        value="<?php echo Sanitize::escape($member->getData()->country); ?>">
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea name ="bio" class="form-control" rows="3"><?php echo Sanitize::escape($member->getData()->bio); ?></textarea>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-4">
                            <button name="register" id = "register" type="submit" class="btn btn-default grey-background">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </body>
</html>