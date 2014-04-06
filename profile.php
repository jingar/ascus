<?php
require_once 'core/init.php';
$memberData = new Member(Input::get('id'));
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
            <h1 style="text-align: center"><?php echo $memberData->getData()->name; ?></h1>
            <div class="location-block">
                <?php
                if(!empty($memberData->getData()->country) && !empty($memberData->getData()->country))
                {
                    echo '<i class="glyphicon glyphicon-map-marker"></i>';
                    echo '<h4 class="location">' . $memberData->getData()->city . ',' . $memberData->getData()->country . '</h4>';
                }
                else if(empty($memberData->getData()->city) && !empty($memberData->getData()->country))
                {
                    echo '<i class="glyphicon glyphicon-map-marker"></i>', PHP_EOL;
                    echo '<h4 class="location">' . $memberData->getData()->country . '</h4>';
                }
                else if(empty($memberData->getData()->country) && !empty($memberData->getData()->city))
                {
                    echo '<i class="glyphicon glyphicon-map-marker"></i>', PHP_EOL;
                    echo '<h4 class="location">' . $memberData->getData()->city . '</h4>';
                }
                ?>
            </div>
            <div>
                <img class="profile-pic" src="<?php echo $memberData->getData()->profile_pic; ?>">
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
                <div>
                    <h4>Experience</h4>
                    <?php
                    $experience = new Experience();
                    $experienceArray = $experience->findAllExperiences($memberData->getData()->members_id);
                    foreach ($experienceArray as $value) {
                        echo '<div class="experience-unit">';
                        echo   '<div>';
                        echo    '<span class="glyphicon glyphicon-briefcase"></span>';
                        echo     '<p class="work-project-name">' . $value->work_project_name . '</p>';
                        echo   '</div>';
                        echo   '<div>';
                        echo    '<span class="glyphicon glyphicon-share"></span>';
                        echo    '<p class="work-project-name"> <a href=' . $value->link .' >' . 
                                    $value->link . '</a></p>';
                        echo   '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class ="col-md-9 profile-right-section">
            <div>
                <h2>About Me</h2>
                <p>
                    <?php echo $memberData->getData()->bio; ?>
                </p>
                <hr>
            </div>
            <?php 
            $memberCollaboration = new MemberCollaborationType();
            $memberCollaborationTypes = $memberCollaboration->FindAllMemberCollaborationTypes($memberData->getData()->members_id);
            if(!empty($memberCollaborationTypes))
            {
            ?>
            <div>
                <div class="collaboration-amount">
                    <h2><i class="glyphicon glyphicon-time"></i> Collaboration</h2>
                    <?php 
                    foreach ($memberCollaborationTypes as $collaboration) {
                        echo '<p>' . $collaboration->collaboration_type . '</p>';
                    }
                    }
                    ?>
                </div>
                 <?php 
                 if(!empty($memberData->getData()->collaboration_amount))
                 {
                   $collaborationAmountArray = explode("(",$memberData->getData()->collaboration_amount); 
                 ?>
                <div class="collaboration-type">
                    <h2><i class="glyphicon glyphicon-calendar"></i> Availability</h2>
                        <?php 
                            $collaborationAmountArray = explode("(",$memberData->getData()->collaboration_amount); 
                            echo '<p>' . $collaborationAmountArray[0] . '</p>';
                            echo '<p>' . explode(')', $collaborationAmountArray[1])[0] . '</p>';
                        }
                        ?>
                </div>
                <hr>
            </div>
            <div>
                <h2> Work Samples </h2>
                <div class="galleria">
                    <?php
                    $workSample = new WorkSample();
                    $memberWorkSamples = $workSample->findByMemberID(array($memberData->getData()->members_id));
                    foreach ($memberWorkSamples as $w) {
                        echo '<img class="worksample"src="'. $w->path .'" data-title="'. $w->title . 
                        '" data-description="' . $w->description.'">';                    
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/tag-it.min.js"></script>
    <script type="text/javascript" src="js/UrlParser.js"></script>
    <script type="text/javascript" src="js/DisplayTags.js"></script>
    <script src="js/galleria-1.3.5.min.js"></script>
    <script>
        Galleria.loadTheme('js/galleria.classic.min.js');
        Galleria.configure({'debug': false});
        Galleria.run('.galleria');
    </script>
</body>
</html>
