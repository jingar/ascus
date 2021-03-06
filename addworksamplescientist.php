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
    		$worksample->addWorkSample(array(NULL,$member->getData()->members_id,NULL,NULL,Input::get('title'),
    			Input::get('description')));
    		Session::flash('Work sample uploaded', 'Work sample uploaded successfully');
    		Redirect::to('showworksamples.php?id=' . $member->getData()->members_id);
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
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fileupload.css">
    <link rel="stylesheet" href="css/strapped.css">

</head>
<?php require_once('./includes/header-inc.php'); ?>
<body>
    <div class="container">
        <div class ="push-down">
            <fieldset>
                <legend>Work Samples</legend>
            </fieldset>
            <ul class="nav nav-tabs">
                <li>
                    <a href="<?php echo Sanitize::escape('editprofile.php?id=' . $member->getData()->members_id)?>">
                        Edit Profile
                    </a>
                </li>
            </ul>
            <form id="worksample_form" class="push-down" role="form" method ="post" enctype="multipart/form-data" action ="">
            	<div class="form-group">
            		<label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Title">
                </div>
                <div class="form-group">
                <label for="description">Description</label>
                    <textarea name ="description" class="form-control" rows="3" id="description" placeholder="Short Description of 500 Characters. Feel free to include external link to work sample"></textarea>
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
                <div class="form-group">
                    <div>
                        <button name="addworksample" id = "addworksample" type="submit" class="btn btn-primary">Add Work Sample</button>
                    </div>
                </div>
            </form>
        </div>
    </div>  
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/addWorkSample.js"></script> 
</body>
</html>