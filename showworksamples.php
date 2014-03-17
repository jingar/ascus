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

$flash = "";
if (Session::exists('File uploaded')) {
  $flash = '<div class="alert alert-success"> <strong>' . Session::flash("File uploaded"). '</strong></div>';
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/strapped.css">
</head>
<?php require_once('./includes/header-inc.php'); ?>
<body>
    <div class="container">
        <div>
            <fieldset class="push-down">
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
            <?php echo $flash; ?>   
            <a class="btn btn-primary push-down" href="<?php echo Sanitize::escape('addworksample.php?id=' . $member->getData()->members_id)?>">
                Add Work Sample
            </a>
      
            <table class="table table-stripped">
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
                                <td><img src=" . $ws->path . " class=\"worksample\"></img></td>
                                <td>" . $ws->title . "</td>
                                <td style=\"word-break: break-all\">" . $ws->description . "</td>
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
      <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
</body>
</html>