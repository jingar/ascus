<?php
require_once './core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ascus &mdash; Search</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/jquery.tagit.css" type="text/css">
  <link rel="stylesheet" href="css/tagit.ui-zendesk.css" type="text/css">
  <link href="css/strapped.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
</head>
<body>
  <?php require_once 'includes/header-inc.php'; ?>
  <div id="jumbo-container">
    <div class="search-header">
      <h1> Find Talent </h1>
    </div>
    <div class="search-container"> 
      <div>
        <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="search-tags">
        </ul>
      </div>
    </div>
    <div>
      <div class="col-md-offset-1 col-md-3 profile-info">
      <div class="occupation">
        <p>Artist</p>
      </div>
        <hr class="hr-search-profile">
        <div>
          <div class="search-profile-image-container">
            <img class="search-profile-image" src="worksamples/profile-pic/defaultprofile.png">
          </div>
          <div class="search-name-location">
            <div>
              <p class="lead">Tim</p>
            </div>
            <div class="location-block">
              <i class="glyphicon glyphicon-map-marker"></i><h5 class="location">Edinburgh,Scotland</h5>
            </div>
          </div>
        </div>
        <hr>
        <div>
          Skills:
        </div>
        <div>
          Interests:
        </div>
        <div>
          Collaboration: 
        </div>
        <div>
          Experience: 
        </div>
      </div>
      <div class="col-md-3 profile-info">
      <div class="occupation">
        <p>Scientist</p>
      </div>
        <hr class="hr-search-profile">
        <div class="search-profile-image-container">
          <img src="https://neil.fraser.name/news/2009/MadScientist.jpg" class="search-profile-image">
        </div>
        <div class="search-name-location">
          <p> Andy "bean" Whitelaw</p>
          <p>Location: </p>
        </div>
        <div>
          Skills:
        </div>
        <div>
          Interests:
        </div>
        <div>
          Collaboration:
        </div>
        <div>
          Experience: 
        </div>
      </div>
      <div class="col-md-3 profile-info">
        <div class="occupation">
          <p>Artist</p>
        </div>
        <hr>
      </div>
    </div>
  </div> <!-- New -->
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
  <?php require_once 'includes/footer.php' ?>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/jquery-ui.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/tag-it.min.js"></script>
  <script type="text/javascript" src="js/SearchTags.js"></script>
</body>
</html>
