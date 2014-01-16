<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php require_once('./php/css-js-inc.php'); ?>
        <title>Profile</title>
    </head>
    <body>
        <?php require_once('./php/header-inc.php'); ?>
        <div class="container push-down">
            <div class ="row">
                <div class ="col-md-4 push-down-further">
                    <img class = "profile-pic" style="float:left" src="https://graph.facebook.com/72612657/picture?width=90&height=90"/>
                </div>
                <div class ="col-md-1">
                </div>
                <div class ="col-md-6">
                    <h1>Fred Yelagavich</h1>
                    <div class="center profile-heading">
                        <i class="glyphicon glyphicon-map-marker"></i>
                        <h4>Moscow, Russia</h4>
                    </div>
                    <p class="large-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Praesent nec nunc convallis, commodo mauris in, fermentum orci. 
                        Donec consequat risus in luctus eleifend.
                        Morbi cursus vel risus ut pretium. Praesent bibendum libero velit. 
                        Fusce ullamcorper luctus sem et ullamcorper. 
                        Maecenas at elit ac est venenatis pellentesque. Quisque vestibulum ullamcorper tincidunt. 
                        Etiam tincidunt tellus mattis purus varius, in sollicitudin risus sagittis.
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
                    <li>Freelancing</li>
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
