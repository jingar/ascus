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
    <div class="row">
      <div class="col-md-offset-1 col-md-3 profile-info">
        <div class="occupation">
          <p>Artist</p>
        </div>
        <hr class="hr-search-profile">
        <div>
          <img class="search-profile-image"src="https://graph.facebook.com/72612657/picture?width=90&height=90">
          <div class ="search-name-location">
            <p class="lead name">Fred Yelagavich</p>
            <div>
              <i class="glyphicon glyphicon-map-marker" style="float:left"></i>
              <p>Moscow, Russia </p>
            </div>
          </div>
        </div>
        <hr>
        <div>
          <div class="info-label">
            <p>Skills: </p> 
          </div>
          <div class="info-skills">
            <p> Photography,Art</p>
          </div>
        </div>
        <div>
          <div class="info-label">
            <p>Interests: </p> 
          </div>
          <div class="info-interests">
            <p>Digital Photography, Sculpture</p>
          </div>
        </div>
        <div>
          <div class="info-label">
            <p>Experience: </p> 
          </div>
          <div class="info-work-experience">
            <p>North Park University,</p>
          </div>
          <div class="info-work-experience">
            <p>The Kentucky Center</p>
          </div>
        </div>
        <div>
          <div class="info-label">
            <p>Blog: </p> 
          </div>
          <div class="info-work-experience">
            <a>www.super-artist.blog.co.uk</a>
          </div>
        </div>
      </div>
      <div class="col-md-3 profile-info">
        <div class="occupation">
          <p>Scientist</p>
        </div>
        <hr class="hr-search-profile">
        <div>
         <img class="search-profile-image" src="https://graph.facebook.com/100001048910716/picture?width=90&height=90">
         <div class ="search-name-location">
          <p class="lead name">Charles Darwin</p>
          <div>
            <i class="glyphicon glyphicon-map-marker" style="float:left"></i>
            <p>London, United Kingdom </p>
          </div>
        </div>
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
      <div class="col-md-3 profile-info">
        <div class="occupation">
          <p>Artist</p>
        </div>
        <hr class="hr-search-profile">
        <img class="search-profile-image" src="http://www.michelangelo.com/buon/images/bio-splash-l-bw.gif">
        <div class="search-name-location">
          <p class="lead name">Michelangelo</p>
          <div class ="person-location">
            <i class="glyphicon glyphicon-map-marker" style="float:left"></i>
            <p>Rome, Italy </p>
          </div>
        </div>
        <hr>
        <div>
          <div class="info-label">
            <p>Skills: </p> 
          </div>
          <div class="info-skills">
            <p>Sculptor, Painting</p>
          </div>
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
  <?php require_once 'includes/footer.php' ?>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/jquery-ui.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/tag-it.min.js"></script>
  <script type="text/javascript" src="js/SearchTags.js"></script>
</body>
</html>
