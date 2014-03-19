<?php
require_once 'core/init.php';
$member = new Member(Input::get('id'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/strapped.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.tagit.css" type="text/css">
    <link rel="stylesheet" href="css/tagit.ui-zendesk.css" type="text/css">
    <link href="css/galleria.classic.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
    <title>Profile</title>
</head>
<body class="noisy-net">
    <?php require_once('includes/header-inc.php'); ?> 
    <div class="profile-content">
        <div class ="col-md-3 profile-left-section">
            <h1 style="text-align: center"><?php echo $member->getData()->name; ?></h1>
            <div class="location-block">
                <i class="glyphicon glyphicon-map-marker">
                </i>
                <h4 class="location">Moscow, Russia</h4>
            </div>
            <div>
                <img class = "profile-pic" src="<?php echo $member->getData()->profile_pic; ?>"/>
            </div>
            <div class="profile-list">
                <div>
                    <h4>Skills</h4>
                    <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="display-tags">
                    </ul> 
                </div>
            </div>
            <div class="profile-list">
                <div>
                    <h4>Interests</h4>
                    <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="display-interest-tags">
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
                <?php echo $member->getData()->bio; ?>
            </p>
            <hr>
            <h2> Work Samples </h2>
            <div class="galleria">
                <?php
                $workSample = new WorkSample();
                $memberWorkSamples = $workSample->findByMemberID(array($member->getData()->members_id));
                foreach ($memberWorkSamples as $w) {
                    echo '<img class="worksample"src="'. $w->path .'" data-title="'. $w->title . 
                    '" data-description="' . $w->description.'">';                    
                }
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/tag-it.min.js"></script>
    <script type="text/javascript" src="js/DisplayTags.js"></script>
    <script src="js/galleria-1.3.5.min.js"></script>
    <script>
        Galleria.loadTheme('js/galleria.classic.min.js');
        Galleria.configure({'debug': false});
        Galleria.run('.galleria');
    </script>
</body>
</html>
