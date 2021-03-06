<?php
require_once 'core/init.php';
$member = new Member();
$memberCollaborationTypes = new MemberCollaborationType();
$experience = new Experience();

if(!$member->isLoggedIn()){
    Session::flash('Failure', 'You must login before you can edit a profile');
    Redirect::to('homepage.php');
}

if($member->getData()->members_id !== Input::get('id'))
{
    Session::flash('Failure', 'You do not have access to edit that users profile');
    Redirect::to("homepage.php");
}
if (Input::exists()) {
    if(Token::check(Input::get('csrf_token')))
    {
        try {
            //if profile picture is picked then upload
            if(!empty($_FILES['file']['name']))
            {
            // need this because upload library makes uppercase extension to lowercase while it keeps the actuall
            // name unchanged.
                $fileName = File::uniqueFileName($_FILES['file']['name']);
                $handle = new upload($_FILES['file']);
                if($handle->uploaded)
                {
                    $handle->image_ratio = true;
                    $handle->file_is_image = true;
                    $handle->image_resize = true;
                    $handle->image_x = 150;
                    $handle->image_x = 150;
                    $handle->file_new_name_body = $fileName;
                    $handle->process('worksamples/profile-pic');
                    if($handle->processed)
                    {
                        $member->editMember(array(Input::get('name'),Input::get('profession'),Input::get('city'),Input::get('country'),
                            Input::get('bio'),'worksamples/profile-pic/' . $handle->file_dst_name,Input::get('collaboration-time'),
                            Input::get('personal_site')));
                    }
                    else 
                    {
                        echo 'error : ' . $handle->error;
                        var_dump($handle->log);
                    }
                }
            }
            else
            {
                $member->editMember(array(Input::get('name'),Input::get('profession'),Input::get('city'),Input::get('country'),
                    Input::get('bio'),$member->getData()->profile_pic,Input::get('collaboration-time'),Input::get('personal_site')));
            }
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';
            //var_dump(Input::get('collaboration-time'));

            $expertise = new Expertise();
            $memberExpertise = new MemberExpertise();            
            $expertise->addExpertise(Input::get('tags'));

            //Find all the expertise related to the member
            $expertiseRows = $memberExpertise->findAllMemberExpertise($member->getData()->members_id);
            $deletedTagsId = array();

            //check if the entered tags match the tags that were already in the database
            //the ones that are in the database and not in input means they must be deleted
            if(!empty(Input::get('tags')))
            {
                //get the ids of tags that the member is deleted
                foreach($expertiseRows as $expertiseRow)
                {
                    if(array_search($expertiseRow->expertise,Input::get('tags')) === FALSE)
                    {
                        $deletedTagsId [] = $expertiseRow->expertise_id;
                    }
                }

                // for each tag entered link it to the member
                foreach(Input::get('tags') as $tag)
                {
                    $memberExpertise->addMemberExpertise($member->getData()->members_id,
                        $expertise->findByExpertise($tag)->expertise_id);
                }
            }
            else
            {
                //if the input tags are empty delete all expertise related to that user
                foreach ($expertiseRows as $expertiseRow) {
                    $deletedTagsId [] = $expertiseRow->expertise_id;
                }
            }

                    //delete tags realted to the member if their are any
            if(!empty($deletedTagsId))
            {
                       // add the tags / replace any that were already inserted
                $memberExpertise->deleteAllByExpertiseId($deletedTagsId);
            }

            $interest = new Interest();
            $interest->deleteAll(array($member->getData()->members_id));
            if(!empty(Input::get('interest-tags')))
            {
                foreach (Input::get('interest-tags') as $interest_tag) {
                    $interest->addInterest(array($member->getData()->members_id,$interest_tag));
                }
            }

            $memberCollaborationTypes->deleteAll($member->getData()->members_id);
            if(!empty(Input::get('collaboration_type')))
            {
                $collaborationType = new CollaborationType();
                foreach (Input::get('collaboration_type') as $c)
                {
                    $memberCollaborationTypes->addMemberCollaborationType($member->getData()->members_id,
                       $collaborationType->findCollaborationId($c)->collaboration_type_id);
                }
            }
            $experience->deleteAll($member->getData()->members_id);
            if(Input::valueExists('experience'))
            {
                $experience->addExperiences($member->getData()->members_id,Input::get('experience'));
            }
        } catch (Exception $ex) {
            echo $ex; 
        }

    }
}
?>
<!DOCTYPE html >
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.tagit.css" type="text/css">
    <link rel="stylesheet" href="css/tagit.ui-zendesk.css" type="text/css">
    <link rel="stylesheet" href="css/jquery.fileupload.css">
    <link rel="stylesheet" type="text/css" href="css/strapped.css">
</head>
<?php require_once('./includes/header-inc.php'); ?>
<body>
    <div class="container">
        <div class="push-down">
            <fieldset>
                <legend>Edit Profile</legend>
            </fieldset>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="<?php echo Sanitize::escape('editprofile.php?id=' . $member->getData()->members_id)?>">
                        Edit Profile
                    </a>
                </li>
                <li>
                    <a href="<?php echo Sanitize::escape('showworksamples.php?id=' . $member->getData()->members_id)?>">
                        Work Samples
                    </a>
                </li>
            </ul>
            <form id="editprofile_form" class="push-down" role="form" method ="POST" enctype="multipart/form-data" action ="">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" 
                    value="<?php echo Sanitize::escape($member->getData()->name); ?>">
                </div>
                <div class="form-group">
                    <label for="professions">Profession</label>
                    <?php $profession = $member->getData()->profession?>
                    <select name="profession" class="form-control">
                        <option value="Artist" <?php echo (($profession === "Artist") ? "selected" : "");?> >Artist</option>
                        <option value="Scientist" <?php echo (($profession === "Scientist") ? "selected" : "");?> >Scientist</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Skills</label>
                    <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="tags">
                    </ul> 
                </div>

                <div class="form-group">
                    <label>Interests</label>
                    <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="interest-tags">
                    </ul> 
                </div>
                <div id="experience_form">
                    <label>Experience</label>
                    <?php 
                      $experienceArray = $experience->findAllExperiences($member->getData()->members_id);
                    ?>
                    <div class="form-group" id="<?php echo count($experienceArray);?>">
                        <button name="add_experience" id="add_experience" type ="button" class="btn btn-success">Add Experience</button>
                    </div>
                    <?php
                    $counter = 0;
                    foreach ($experienceArray as $exp)
                    {
                        echo "<div class=\"form-group\">" .
                        "<input name=\"experience[". $counter ."][work_project]\" type=\"text\" class=\"form-control experience-input\" value=\"" . $exp->work_project_name . "\" placeholder=\"Work Place/ Project Name\">" .
                        "<input name=\"experience[". $counter ."][link]\" type=\"text\" class=\"form-control experience-input\" value=\"". $exp->link . "\" placeholder=\"Link to your work place or project\">" .
                        "<button name=\"remove_button\" type=\"button\" class=\"btn btn-danger\">remove</button>" .
                        "</div>";
                        ++$counter;
                    }
                    ?>
                </div>
                <div>
                    <label>Collaboration</label>
                    <div>
                        <div class="form-group">
                            <?php  
                            $collaborationTypeArray = array();
                            foreach ($memberCollaborationTypes->FindAllMemberCollaborationTypes($member->getData()->members_id) as $v) {
                                $collaborationTypeArray[] = $v->collaboration_type;
                            }
                            ?>

                            <div class="checkbox">
                                <label>
                                    <input name="collaboration_type[]" type="checkbox" value="No Collaboration" <?php echo (in_array("No Collaboration" , $collaborationTypeArray) ? "Checked" : "")?> > No Collaboration
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="collaboration_type[]" type="checkbox" value="Paid Work" <?php echo (in_array("Paid Work" , $collaborationTypeArray) ? "Checked" : "")?> > Paid Work
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="collaboration_type[]" type="checkbox" value="Volunteer Work" <?php echo (in_array("Volunteer Work" , $collaborationTypeArray) ? "Checked" : "")?> > Volunteer Work
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select id="collaboration-time" name="collaboration-time" class="form-control">
                            <?php $collaborationAmount = $member->getData()->collaboration_amount;?>
                            <option <?php echo (($collaborationAmount === "Weekends(8 Hours per Week)") ? "selected" : "");?> >Weekends(8 Hours per Week)</option>
                            <option <?php echo (($collaborationAmount === "Part Time(20 Hours per Week)") ? "selected" : "");?> >Part Time(20 Hours per Week)</option>
                            <option <?php echo (($collaborationAmount === "Full Time(40 Hours per Week)") ? "selected" : "") ;?> >Full Time(40 Hours per Week)</option>
                            <option <?php echo (($collaborationAmount === "Every day(60 Hours per Week)") ? "selected" : "") ;?> >Every day(60 Hours per Week)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input name="city" type="text" class="form-control" id="city" placeholder="City"
                    value="<?php echo Sanitize::escape($member->getData()->city); ?>">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input name="country" type="text" class="form-control" id="country" placeholder="Country"
                    value="<?php echo Sanitize::escape($member->getData()->country); ?>">
                </div>
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name ="bio" class="form-control" rows="3"><?php echo Sanitize::escape($member->getData()->bio); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="profile-pic">Profile Picture</label>
                    <div>
                        <img id="profile-pic" src="<?php echo Sanitize::escape($member->getData()->profile_pic); ?>" width="75px">
                        <span id="file_span" class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Pick a profile picture</span>
                            <input type="file" name="file" id="file" onchange="readURL(this);">             
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="personal_site">Personal Site</label>
                    <input name="personal_site" type="text" class="form-control" id="city" placeholder="Personal Site"
                    value="<?php echo Sanitize::escape($member->getData()->personal_site); ?>">
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
                <div id="tagChanges" style="display: none;">
                    <ul>
                    </ul>
                </div>
                <div>
                    <button name="editprofile" id = "editprofile" type="submit" class="btn btn-warning">Save Changes</button>
                </div>
            </form>
        </div> 
    </div>
    <?php require_once 'includes/footer.php' ?>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/editprofile.js"></script>
    <script type="text/javascript" src="js/tag-it.min.js"></script>
    <script type="text/javascript" src="js/UrlParser.js"></script>
    <script type="text/javascript" src="js/GetTags.js"></script>
    <script type="text/javascript" src="js/AddTags.js"></script>
    <script type="text/javascript" src="js/AddExperience.js"></script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile-pic').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#datepicker').datepicker();
    </script>
</body>
</html>