<?php
require_once 'core/init.php';
$member = new Member();

if(!$member->isLoggedIn()){
    Redirect::to('homepage.php');
}
if($member->getData()->members_id !== Input::get('id'))
{
    Redirect::to(404);
}
if (Input::exists()) {
    if(Token::check(Input::get('csrf_token')))
    {
        try {
            $member->editMember(array(Input::get('name'),Input::get('city'),Input::get('country'),
                Input::get('bio')));

            $expertise = new Expertise();
            $memberExpertise = new MemberExpertise();

            // Add the expertise entered, takes care of duplicated expertise
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
    <?php require_once('./classes/css-js-inc.php'); ?>
    <link rel="stylesheet" href="css/jquery.tagit.css" type="text/css">
    <link rel="stylesheet" href="css/tagit.ui-zendesk.css" type="text/css">
    <script type="text/javascript" src="js/editprofile.js"></script>
    <script type="text/javascript" src="js/GetTags.js"></script>
    <script type="text/javascript" src="js/AddTags.js"></script>
</head>
<?php require_once('./classes/header-inc.php'); ?>
<body>
    <div class="container">
        <div class ="box">
            <fieldset class="push-down-further">
                <legend>Edit Profile</legend>
            </fieldset>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="<?php echo Sanitize::escape('editprofile.php?id=' . $member->getData()->members_id)?>">
                        Edit Profile
                    </a>
                </li>
                <li><a href="#">Username & Password</a></li>
                <li>
                    <a href="<?php echo Sanitize::escape('showworksamples.php?id=' . $member->getData()->members_id)?>">
                        Work Samples
                    </a>
                </li>
            </ul>
            <form id="editprofile_form" class="push-down" role="form" method ="POST" action ="">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" 
                    value="<?php echo Sanitize::escape($member->getData()->name); ?>">
                </div>
                <div class="form-group">
                    <label>Expertise</label>
                    <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="tags">
                    </ul> 
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
                    <textarea name ="bio" class="form-control" rows="3"><?php echo Sanitize::escape($member->getData()->bio); ?></textarea>
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
                <div id="tagChanges" style="display: none;">
                    <ul>
                    </ul>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-4">
                        <button name="editprofile" id = "editprofile" type="submit" class="btn btn-default grey-background">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>  
</body>
</html>