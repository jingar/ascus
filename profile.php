<?php
require_once 'core/init.php';
$member = new Member();
$member_data = $member->findByID(Input::get('id'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/strapped.css" rel="stylesheet">
    <link href="css/galleria.classic.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
    <title>Profile</title>
</head>
<body class="noisy-net">
    <?php require_once('includes/header-inc.php'); ?> 
    <div class="profile-content">
        <div class ="col-md-3 profile-left-section">
            <h1 style="text-align: center"><?php echo $member_data->name; ?></h1>
            <div class="location-block">
                <i class="glyphicon glyphicon-map-marker">
                </i>
                <h4 class="location">Moscow, Russia</h4>
            </div>
            <div>
                <img class = "profile-pic" src="https://graph.facebook.com/72612657/picture?width=90&height=90"/>
            </div>
            <div class="profile-list">
                <div>
                    <h4>Skills</h4>
                    <ul>
                        <li>Photography</li>
                        <li>Art</li>
                    </ul>
                </div>
            </div>
            <div class="profile-list">
                <div >
                    <h4>Experience</h4>
                    <ul>
                        <li>Maecenas vitae euismod tortor.</li>
                        <li>Integer ornare nullam</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class ="col-md-9 profile-right-section">
            <h2>Bio</h2>
            <p>
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
            <hr>
            <h2> Work Samples </h2>
            <div class="galleria">
                <img class="worksample" src="images/stock1.jpg" data-title="My title" data-description=" Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
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
                Integer ornare nullam">
                <img class="worksample" src="images/stock2.jpg" data-title="My title" data-description="My description">
                <img class="worksample" src="images/stock3.jpg" data-title="My title" data-description="My description">
                <img class="worksample" src="images/stock4.jpg" data-title="My title" data-description="My description">
                <img class="worksample" src="images/stock5.jpg" data-title="My title" data-description="My description">
                <img class="worksample" src="images/banner.png" data-title="My title" data-description="My description">
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/galleria-1.3.5.min.js"></script>
    <script>
        Galleria.loadTheme('js/galleria.classic.min.js');
        Galleria.configure({'debug': false});
        Galleria.run('.galleria');
    </script>
</body>
</html>
