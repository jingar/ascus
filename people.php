<?php
require_once './core/init.php';
$member = new Member();
$mergedMembers = array();
if (Input::exists()) {
    if(Token::check(Input::get('csrf_token')))
    {
      if(Input::get('search-profession') !== 'Any')
      {
        $mergedMembers = $member->findAllByProfession(Input::get('search-profession'));
      }
      else
      {
        $mergedMembers = $member->getAll();
      }
      
      if(!empty(Input::get('search-location')))
      {
        foreach ($mergedMembers as $key => $member) {
          if($member->city !== Input::get('search-location'))
          {
            unset($mergedMembers[$key]);
          }
        }
      }

      if(!empty(Input::get('tags')))
      {

        $expertise = new Expertise();
        $interest = new Interest();
        $wordManager = new WordManager();

        $finalTags = Input::get('tags');
        $finalTags = array_merge($finalTags,$wordManager->findAnyLinkedWordArray(Input::get('tags')));
        $finalTags = array_merge($finalTags,$wordManager->findSynonymsArray(Input::get('tags')));
        $foundTaggedMembers = array();
        //get a multidimensional array of users which match the tags entered, have to look through
        //expertise and interests as we dont which type is entered
        foreach ($finalTags as $tag) {
        //check if its tag entered by user (array) of if its a database row
          $tag = (is_object($tag)) ? $tag->lemma : $tag;

          $foundTaggedMembers[] = $expertise->findMembersByExpertise($tag);
          $foundTaggedMembers[] = $interest->findMembersByInterest($tag);
        }


        //remove any null values
        $foundTaggedMembers = array_filter($foundTaggedMembers);
        //if any memebers with the inputted or similar tags were found, flatten the array 
        //and then remove duplicates
        if(!empty($foundTaggedMembers))
        {
          //flatten array
          $foundTaggedMembers = call_user_func_array('array_merge', $foundTaggedMembers);
          var_dump($foundTaggedMembers);
          var_dump($mergedMembers);
          //for each member found check if that member was in the tagged member array
          // if not remove them         
          foreach ($mergedMembers as $key => $current) {
            if (!in_array($current, $foundTaggedMembers)) {
              unset($mergedMembers[$key]);
            }
          }
        }
      }
    }
  }
  else
  {
    $databaseConnection = Database::getInstance();
    $query = "select members.members_id,profession,name,city,country,profile_pic,personal_site from members
    LIMIT 0, 12";
    $databaseConnection->query($query);
    $mergedMembers = $databaseConnection->getResults();
  }
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
  <div class="wrapper">
  <?php require_once 'includes/header-inc.php'; ?>
  <div id="jumbo-container">
    <div class="search-header">
      <h1> Find Talent </h1>
    </div>
    <form id="editprofile_form" class="push-down" role="form" method ="POST" enctype="multipart/form-data" action ="">
      <div class="row">
        <div class="col-md-offset-1 col-md-2">
          <select name="search-profession" class="form-control"> 
            <option value="Any">Any</option>
            <option value="Artist">Artist</option>
            <option value="Scientist">Scientist</option>
          </select>
        </div>
        <div class="col-md-3">
          <input name="search-location" type="text" class="form-control" value="" placeholder="City">
        </div>
        <div class="col-md-4">
          <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="search-tags">
          </ul>
        </div>
        <div class="col-md-1">
          <button name="search-button" id = "editprofile" type="submit" class="btn btn-info">Search</button>
        </div>
      </div>
      <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
    </form>
    <?php
    $counter = 0;
    if($counter % 3 === 0){echo '<div class="row">';}
    foreach ($mergedMembers as $member) {
      ?>
      <div class="<?php if($counter % 3 === 0){echo 'col-md-offset-1';} ?> col-md-3 profile-info">
        <div class="occupation">
          <p><?php echo $member->profession; ?></p>
        </div>
        <hr class="hr-search-profile">
        <div class="row">
          <div class="col-md-4 col-sm-4">
            <a style="color:white" href="<?php echo Sanitize::escape('profile.php?id='. $member->members_id); ?>">
              <img class="search-profile-image"src="<?php echo $member->profile_pic; ?>">
            </a>
          </div>
          <div class ="col-md-7">
            <p class="lead name">
              <a style="color:white" href="<?php echo Sanitize::escape('profile.php?id='. $member->members_id); ?>">
              <?php echo $member->name; ?>
              </a>
            </p>
            <div>
              <?php
                if(!empty($member->country) && !empty($member->city))
                {
                    echo '<i class="glyphicon glyphicon-map-marker" style="float:left"></i>';
                    echo '<p class="location">' . $member->city . ',' . $member->country . '</p>';
                }
                else if(empty($member->city) && !empty($member->country))
                {
                    echo '<i class="glyphicon glyphicon-map-marker"></i>', PHP_EOL;
                    echo '<p class="location">' . $member->country . '</p>';
                }
                else if(empty($member->country) && !empty($member->city))
                {
                    echo '<i class="glyphicon glyphicon-map-marker"></i>', PHP_EOL;
                    echo '<p class="location">' . $member->city . '</p>';
                }
                ?>
            </div>
          </div>
        </div>
        <hr>
        <div>
          <div class="info-label">
            <p>Skills: </p> 
          </div>
          <div>
            <?php $memberExpertise = new MemberExpertise(); 
                  $memberExpertiseArray = $memberExpertise->findAllMemberExpertise($member->members_id);
                  echo '<ul class="tagit ui-widget ui-widget-content ui-corner-all search-expertise-tags" id="search_tags_' . $counter . '">';
                  foreach ($memberExpertiseArray as $expertise) 
                  {
                    echo '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-read-only">
                            <span class="tagit-label">' . $expertise->expertise .'</span>
                            <input type="hidden" value="photography" name="tags" class="tagit-hidden-field">
                          </li>';
                        }
                  if(count($memberExpertiseArray) > 3)
                    {  
                      echo '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-read-only">
                      <span class="tagit-label">...</span>
                      <input type="hidden" value="photography" name="tags" class="tagit-hidden-field">
                    </li>';}                  
                  echo '</ul>';                  
            ?>
          </div>
        </div>
        <div>
          <div class="info-label">
            <p>Interests: </p> 
          </div>
          <div>
           <?php $memberInterest = new Interest(); 
           $memberInterestArray = $memberInterest->findAllInterests(array($member->members_id));
           echo '<ul class="tagit ui-widget ui-widget-content ui-corner-all search-interest-tags" id="search_tags_' . $counter . '">';
           foreach ($memberInterestArray as $interest) 
           {
            echo '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-read-only">
            <span class="tagit-label">' . $interest->interest .'</span>
            <input type="hidden" value="photography" name="tags" class="tagit-hidden-field">
          </li>';
        }
        if(count($memberInterestArray) > 3)
        {
          echo '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-read-only">
            <span class="tagit-label">...</span>
            <input type="hidden" value="photography" name="tags" class="tagit-hidden-field">
          </li>';
        }                  
        echo '</ul>';
        ?>
          </div>
        </div>
        <div>
          <div class="info-label">
            <p>Experience: </p> 
          </div>
          <?php
          $experience = new Experience();
          $memberExperiences = $experience->findAllExperiences($member->members_id);
          foreach ($memberExperiences as $exp) {
            echo '<div class="info-work-experience"><p> ' . $exp->work_project_name . ' </p></div>';
          }
          ?>
        </div>
        <div>
          <div class="info-label">
            <p>Personal Site: </p> 
          </div>
          <div class="info-work-experience">
            <a href="<?php echo Sanitize::escape($member->personal_site); ?>">
            <?php echo Sanitize::escape($member->personal_site); ?>
          </a>
          </div>
        </div>
      </div>
      <?php 
      if(($counter + 1) % 3 === 0){echo '</div> <!-- /row -->';}
      $counter++;}
      if($counter % 3 !== 0 || $counter === 0){echo '</div> <!-- /row -->';}
      ?>
    </div>
  </div>
  <?php require_once 'includes/footer.php' ?>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/jquery-ui.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/tag-it.min.js"></script>
  <script type="text/javascript" src="js/SearchTags.js"></script>
</body>
</html>