<?php
require_once './core/init.php';
if (Session::exists('Login Success')) {
    echo '<div class=container>   
    <div class="alert alert-success">' . Session::flash("Login Success"). '</div>
    </div>';
} 
if(Session::exists('Success Registered')) {
    echo "<div class=\"alert alert-success\">" . Session::flash('Success Registered') . "</div>";
} 

if (Session::exists('Failure')) {
    echo "<div class=\"alert alert-danger\">" . Session::flash('Failure') . "</div>";
}

if (Session::exists('Email Not Activated')) {
    echo "<div class=\"alert alert-danger\">" . Session::flash('Email Not Activated') . "</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8 name="viewport" content="width=device-width, initial-scale="1">
        <title>Ascus</title>
        <?php require_once('./classes/css-js-inc.php'); ?>
    </head>
    <body>
        <?php require_once('./classes/header-inc.php'); ?>
        <div class="banner">
            <h1>Artists and Scientists Collaboration</h1>
            <p class ="lead">Easily find Artists and Scientist for collaboration</p>
            <p><a class="btn-lg sign-up-button" href="register.php" role="button">Sign up today</a></p>
        </div>
        <div class="container">
            <div class ="row push-down">
                <form class="form-horizontal" role="form">
                    <div class="offset col-md-2">
                        <div class="left-inner-addon">
                            <i class="glyphicon glyphicon-user"></i>
                            <input type="text" class="form-control" id="occupation" placeholder="Occupation">
                        </div>
                    </div>
                </form> 
                <form class="form-horizontal" role="form">
                    <div class="col-md-2">
                        <div class="left-inner-addon">
                            <i class="glyphicon glyphicon-map-marker"></i>
                            <input type="text" class="form-control" id="location" placeholder="location">
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" role="form">
                    <div class="col-md-2">
                        <div class="left-inner-addon">
                            <i class="glyphicon glyphicon-record"></i>
                            <input type="text" class="form-control" id="radius" placeholder="Radius (miles)">
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" role="form">
                    <div class="col-md-2">
                        <div class="left-inner-addon">
                            <i class="glyphicon glyphicon-star"></i>
                            <input type="text" class="form-control" id="skills" placeholder="Skills">
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" role="form">
                    <div class="col-md-2">
                        <div class="left-inner-addon">
                            <i class="glyphicon glyphicon-heart"></i>
                            <input type ="text" class="form-control" id="interests" placeholder="Interests">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="offset col-md-3 person-info grey-background">
                    <p class="occupation">Visual Artist</p>
                    <hr>
                    <img class="info-pic" style="float:left" src="https://graph.facebook.com/72612657/picture?width=90&height=90">
                    <p class="lead name">Fred Yelagavich</p>
                    <div class ="person-location">
                        <i class="glyphicon glyphicon-map-marker" style="float:left"></i>
                        <p>Moscow, Russia </p>
                    </div>
                    <hr>
                    <div class="info-label">
                        <p>Skills: </p> 

                    </div>
                    <div class="info-skills">
                        <p> Photography,Art</p>
                    </div>
                    <div class="info-label">
                        <p>Interests: </p> 
                    </div>
                    <div class="info-interests">
                        <p>Digital Photography, Sculpture</p>
                    </div>
                    <div class="info-label">
                        <p>Experience: </p> 
                    </div>
                    <div class="info-work-experience">
                        <p>  North Park University, The Kentucky Center </p>
                    </div>
                    <div class="info-label">
                        <p>Blog: </p> 
                    </div>
                    <div class="info-work-experience">
                        <a>www.super-artist.blog.co.uk</a>
                    </div>
                </div>
                <div class="offset col-md-3 person-info grey-background">
                    <p class="occupation">Geneticist</p>
                    <hr>
                    <img class="info-pic" style="float:left" src="https://graph.facebook.com/100001048910716/picture?width=90&height=90">
                    <p class="lead name">Charles Darwin</p>
                    <div class ="person-location">
                        <i class="glyphicon glyphicon-map-marker" style="float:left"></i>
                        <p>London, United Kingdom </p>
                    </div>
                    <hr>
                    <div class="info-label">
                        <p>Skills: </p> 
                    </div>
                    <div class="info-skills">
                        <p>Genetics, Biology</p>
                    </div>
                    <div class="info-label">
                        <p>Interests: </p> 
                    </div>
                    <div class="info-interests">
                        <p>Start Ups, Educational Tools</p>
                    </div>
                    <div class="info-label">
                        <p>Experience: </p> 
                    </div>
                    <div class="info-work-experience">
                        <p>The Open Data Institute , Teach First</p>
                    </div>
                </div>

                <div class="offset col-md-3 person-info grey-background">
                    <p class="occupation">Sculptor</p>
                    <hr>
                    <img class="info-pic" style="float:left" src="http://www.michelangelo.com/buon/images/bio-splash-l-bw.gif">
                    <p class="lead name">Michelangelo</p>
                    <div class ="person-location">
                        <i class="glyphicon glyphicon-map-marker" style="float:left"></i>
                        <p>Rome, Italy </p>
                    </div>
                    <hr>
                    <div class="info-label">
                        <p>Skills: </p> 
                    </div>
                    <div class="info-skills">
                        <p>Sculptor, Painting</p>
                    </div>
                    <div class="info-label">
                        <p>Interests: </p> 
                    </div>
                    <div class="info-interests">
                        <p>Cultural Critique , Art/Cultural Theory</p>
                    </div>
                    <div class="info-label">
                        <p>Experience: </p> 
                    </div>
                    <div class="info-work-experience">
                        <p>Free lancing, Sculpture David</p>
                    </div>
                </div>
            </div> <!-- /row -->
        </div><!-- /container -->
    </body>
    </html>
