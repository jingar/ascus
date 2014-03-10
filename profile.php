<?php
require_once 'core/init.php';
$member = new Member();
$member_data = $member->findByID(Input::get('id'));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php require_once('classes/css-js-inc.php'); ?>
        <title>Profile</title>
    </head>
    <body>
      <?php require_once('classes/header-inc.php'); ?> 
        <div class="container push-down">
            <div class ="row">
                <div class ="col-md-4 push-down-further">
                    <img class = "profile-pic" style="float:left" src="https://graph.facebook.com/72612657/picture?width=90&height=90"/>
                </div>
                <div class ="col-md-1">
                </div>
                <div class ="col-md-6">
                    <h1><?php echo $member_data->name; ?></h1>
                    <div class="center profile-heading">
                        <i class="glyphicon glyphicon-map-marker"></i>
                        <h4>Moscow, Russia</h4>
                    </div>
                    <p class="large-text">
                        <!--                         <?php echo $member_data->bio; ?> -->
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Praesent at ligula congue, sagittis eros ut, pulvinar erat.
                        Praesent consequat laoreet dapibus.
                        Aliquam eu sapien imperdiet, porttitor mi quis, volutpat neque
                        Aenean lacus nunc, elementum ornare blandit sed, scelerisque eget libero.
                        Praesent adipiscing semper ornare.
                        Nunc eu cursus odio, eget porttitor ipsum.
                        Cras elementum volutpat mauris, sed posuere nulla.
                        Donec posuere mauris ac elit aliquam, at porta augue condimentum.
                        Nulla posuere sit amet sapien vel consequat.
                        Integer ac nulla congue, ultricies lectus sed, adipiscing metus.
                        Quisque ut posuere quam, venenatis lobortis felis.
                        Maecenas vitae euismod tortor.
                        Integer ornare nullam
                    </p>
                </div>
            </div>
        </div>
        <div class ="grey-background">
            <div class="container center">
                <div class="row wrapper">
                    <h1>Skills</h1>
                    <ul>
                        <li>Photography</li>
                        <li>Art</li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="container center">
            <div class="row wrapper">
                <h1>Interests</h1>
                <ul>
                    <li>Digital</li>
                    <li>Photography</li>
                    <li>Sculptures</li>
                </ul>
            </div>
        </div>
        <div class ="grey-background">
            <div class="container center">
                <div class="row wrapper">
                    <h1>Experience</h1>
                    <ul>
                        <li>Currently Freelancing</li>
                        <li>North Park University</li>
                        <li>The Kentucky Center</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container center">
            <div class="row center">
                <h1>Work Samples</h1>
                <ul class="work-samples">
                    <li><img src="https://graph.facebook.com/72612657/picture?width=90&height=90"/></li>
                    <li><img src="https://graph.facebook.com/72612657/picture?width=90&height=90"/></li>
                    <li><img src="https://graph.facebook.com/72612657/picture?width=90&height=90"/></li>
                </ul>
            </div>
        </div>
    </body>
</html>
