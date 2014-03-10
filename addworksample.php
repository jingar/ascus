<?php
require_once 'core/init.php';
require_once 'classes/upload/class.upload.php';
$member = new Member();

if(!$member->isLoggedIn()){
    Session::flash('Access Denied',"You must log in to access that page");
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
            $worksample = new WorkSample();
            $worksample->addWorkSample(array(NULL,$member->getData()->members_id,
                $_FILES['file']['name'],
                'worksamples/' . $_FILES['file']['name'],
                Input::get('title'),
                Input::get('description'),
                ));
            $handle = new upload($_FILES['file']);
            if($handle->uploaded)
            {
                $handle->image_ratio = true;
                $handle->file_is_image = true;
                $handle->process('worksamples');

                if($handle->processed)
                {
                    echo 'worked';
                }
                else
                {
                    echo 'error : ' . $handle->error;
                    echo $handle->log;
                }
            }
      } catch (Exception $ex) {
            echo $ex; 
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="UTF-8">
    <?php require_once('./classes/css-js-inc.php'); ?>
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/jquery.fileupload.css">
    <script type="text/javascript" src="js/uploadFile.js"></script>
    <script type="text/javascript" src="js/addWorkSample.js"></script>
</head>
<?php require_once('./classes/header-inc.php'); ?>
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
                    </a>
                </li>
                <li><a href="#">Username & Password</a></li>
                <li class="active">
                    <a href="<?php echo Sanitize::escape('showworksamples.php?id=' . $member->getData()->members_id)?>">Work Samples
                    </a>
            </ul>
            <form id="worksample_form" class="push-down" role="form" method ="post" enctype="multipart/form-data" action ="">
                <div class="form-group">
                    <span id="file_span" class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Pick a file</span>
                        <input name="file" type="file" name="files" id="file">
                    </span>
                    <span id="fileName"></span>
                </div>
                <div id="file_error">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Title">
                </div>
                <div class="form-group">
                <label for="description">Description</label>
                    <textarea name ="description" class="form-control" rows="3"></textarea>
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-4">
                        <button name="addworksample" id = "addworksample" type="submit" class="btn btn-default grey-background">Add Work Sample</button>
                    </div>
                </div>
            </form>
        </div>
    </div>  
</body>
</html>