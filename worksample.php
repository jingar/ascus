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
    <?php require_once('./classes/css-js-inc.php'); ?>
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/jquery.fileupload.css">
    <script src="js/jquery.ui.widget.js"></script>
    <script src="js/jquery.iframe-transport.js"></script>
    <script src="js/jquery.fileupload.js"></script>
    <script>
        $(function () {
            $('#fileupload').fileupload({
                dataType: 'json',
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo(document.body);
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .bar').css(
                        'width',
                        progress + '%'
                        );
                }
            });
        });
    </script>
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
                    <a href="<?php echo Sanitize::escape('worksample.php?id=' . $member->getData()->members_id)?>">Work Samples
                    </a>
                </li>
            </ul>
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Add files...</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="files[]" multiple>
            </span>
            <br>
            <br>
            <!-- The global progress bar -->
            <div id="progress" class="progress">
                <div class="progress-bar progress-bar-success"></div>
            </div>
            <!-- The container for the uploaded files -->
            <div id="files" class="files"></div>
            <br>
            <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
            <form id="worksamples_form" class="push-down" role="form" method ="POST" action ="">
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