<?php ?>
<!DOCTYPE html >
<html lang="en">
    <head>
        <title>Edit Profile</title>
        <meta charset="UTF-8">
        <?php require_once('./php/css-js-inc.php'); ?>
        <link rel="stylesheet" href="css/jquery.tagit.css" type="text/css">
        <link rel="stylesheet" href="css/tagit.ui-zendesk.css" type="text/css">
        <script type="text/javascript" src="js/AddTags.js"></script>
    </head>
    <?php require_once('./php/header-inc.php'); ?>
    <body>
        <div class="container">
            <div class ="box">
                <fieldset class="push-down-further">
                    <legend>Edit Profile</legend>
                </fieldset>
                <form id="registration_form" class="push-down" role="form" method ="POST" action ="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label>Expertise</label>
                        <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="tags">
                        </ul> 
                    </div>

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
