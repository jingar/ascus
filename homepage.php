<?php
require_once './core/init.php';
$error = "";
if (Session::exists('Login Success')) {
  $error = '<div class="alert alert-success"> <strong>' . Session::flash("Login Success"). '</strong></div>';
} 
if(Session::exists('Success Registered')) {
  $error = '<div class="alert alert-success"> <strong>' . Session::flash('Success Registered') . 
  '</strong></div>';
} 

if (Session::exists('Failure')) {
  $error = '<div class="alert alert-danger">' . Session::flash('Failure') . '</div>';
}

if (Session::exists('Email Not Activated')) {
  $error = '<div class="alert alert-danger">' . Session::flash('Email Not Activated') . '</div>';
}
if (Session::exists('Email Activated')) {
  $error = '<div class="alert alert-success"> <strong>' . Session::flash("Email Activated"). '</strong></div>';
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ascus &mdash; Artist & Scientist Collaboration</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.min.css" rel="stylesheet">
  <link href="css/strapped.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="wrapper">
    <?php require_once 'includes/header-inc.php'; ?>
    <div id="jumbo-container">
      <?php echo $error; ?>   
      <div id="top" class="jumbotron">
        <div class="container">
          <h1>Artist and Scientist Collaboration</h1>
          <hr>
          <h2>Find collaborators like yourselves and make awesome works of art</h2>
          <p><a class="btn btn-warning btn-lg" href="register.php">Sign Up Today <span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
        </div> <!-- /.container -->
      </div> <!-- /.jumbotron -->
    </div>
  </div>
  <?php require_once 'includes/footer.php' ?>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
