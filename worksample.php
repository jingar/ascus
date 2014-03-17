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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/strapped.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/jquery.fileupload.css">
</head>
<?php require_once('./includes/header-inc.php'); ?>
<body>
    <div class="container">
        <div class ="box">
            <fieldset class="push-down-further">
                <legend>Work Samples</legend>
            </fieldset>
            <ul class="nav nav-tabs">
                <li>
                    <a href="<?php echo Sanitize::escape('editprofile.php?id=' . $member->getData()->members_id)?>">
                        Edit Profile
                </li>
                <li><a href="#">Username & Password</a></li>
                <li class="active">
                    <a href="<?php echo Sanitize::escape('worksample.php?id=' . $member->getData()->members_id)?>">Work Samples
                    </a>
                </li>
            </ul>
            <form id="worksamples_form" class="push-down" role="form" method ="post" enctype="multipart/form-data" action ="">
                <div class="form-group">      
                    <a class="btn btn-success fileinput-button" href="<?php echo Sanitize::escape('addworksample.php?id=' . $member->getData()->members_id)?>">
                        <i class="glyphicon glyphicon-plus"></i>    
                        Add Work Sample
                    </a>
                </div>
                <div class="form-group">
                    <table id="files" class="table">
                        <tbody>
                        </tbody>
                    </table>
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