<?php
require_once 'core/init.php';
$member = new Member();

if(!$member->isLoggedIn()){
    Session::flash('Access Denied',"You must log in to access that page");
    Redirect::to('homepage.php');
}
if($member->getData()->members_id !== Input::get('id'))
{
    Redirect::to(404);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="UTF-8">
    <?php require_once('./classes/css-js-inc.php'); ?>
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
</head>
<?php require_once('./classes/header-inc.php'); ?>
<body>
    <div class="container">
        <div class ="box">
            <fieldset class="push-down-further">
                <legend>Work Samples</legend>
            </fieldset>
            <ul class="nav nav-tabs">
                <li>
                    <a href="<?php echo Sanitize::escape('editprofile.php?id=' . $member->getData()->members_id)?>">
                        Edit Profile
                    </a>
                </li>
                <li><a href="#">Username & Password</a></li>
                <li class="active">
                    <a href="<?php echo Sanitize::escape('showworksamples.php?id=' . $member->getData()->members_id)?>">Work Samples
                    </a>
                </li>
            </ul>
            <a class="btn btn-primary" href="<?php echo Sanitize::escape('addworksample.php?id=' . $member->getData()->members_id)?>">
                Add Work Sample
            </a>
      
            <table class="table table-stripped table-hover">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
            </thead>
                <tbody>
                    <?php
                    $worksample = new WorkSample();
                    $worksamples = $worksample->findByMemberID(array($member->getData()->members_id));
                    foreach($worksamples as $ws)
                    {
                        echo "<tr>
                                <td><img src=" . $ws->path . " class=\"width-set height-set\"></img></td>
                                <td>" . $ws->title . "</td>
                                <td style=\"word-break: break-all\">" . $ws->description . "</td>
                                <td><button type=\"button\" class=\"btn btn-info\">Edit</td>
                                <td>
                                    <a href= \"deleteworksample.php?id=" . $member->getData()->members_id . 
                                        "&worksampleid=". $ws->work_samples_id . 
                                        "&imagename=" . $ws->name. "\"class=\"btn btn-danger\"
                                         onclick=\"return confirm('Are you sure?');\">Delete
                                    </a>
                                </td>
                             </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>  
</body>
</html>