<?php
require_once './core/init.php';
$finalMembers = array();
if (Input::exists()) {
    if(Token::check(Input::get('csrf_token')))
    {
      $tags = Input::get('tags');
      $expertise = new Expertise();
      $mergedMembers = array();
      $finalMembers = array();
      //get a multidimensional array of users
      foreach ($tags as $tag) {
        $mergedMembers[] = $expertise->findMembersByExpertise($tag);
      }
      //remove any null values
      $mergedMembers = array_filter($mergedMembers);
      //if any users were found, flatten the array and then remove duplicates
      if(!empty($mergedMembers))
      {
        $mergedMembers = call_user_func_array('array_merge', $mergedMembers);
        foreach ($mergedMembers as $current) {
          if ( ! in_array($current, $finalMembers)) {
            $finalMembers[] = $current;
          }
        }
      }
    }
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
  <?php require_once 'includes/header-inc.php'; ?>
  <div id="jumbo-container">
    <div class="search-header">
      <h1> Find Talent </h1>
    </div>
    <form id="editprofile_form" class="push-down" role="form" method ="POST" enctype="multipart/form-data" action ="">
      <div class="search-container"> 
        <div>
          <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="search-tags">
          </ul>
        </div>
        <div>
          <button name="editprofile" id = "editprofile" type="submit" class="btn btn-info">Search</button>
        </div>
      </div>
      <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
    </form>
    <?php
    $counter = 0;
    if($counter % 3 === 0){echo '<div class="row">';}
    foreach ($finalMembers as $member) {
      ?>
      <div class="<?php if($counter % 3 === 0){echo 'col-md-offset-1';} ?> col-md-3 profile-info">
        <div class="occupation">
          <p><?php echo $member->profession; ?></p>
        </div>
        <hr class="hr-search-profile">
        <div class="row">
          <div class="col-md-5">
            <img class="search-profile-image"src="<?php echo $member->profile_pic; ?>">
          </div>
          <div c Lassc ="col-md-7">
            <p class="lead name"><?php echo $member->name; ?></p>
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
                  if(count($memberExpertiseArray) >= 3)
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
        if(count($memberInterestArray) >= 3)
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
            <p>Blog: </p> 
          </div>
          <div class="info-work-experience">
            <a>www.super-artist.blog.co.uk</a>
          </div>
        </div>
      </div>
      <?php 
      if(($counter + 1) % 3 === 0){echo '</div> <!-- /row -->';}
      $counter++;}
      if($counter % 3 !== 0){echo '</div> <!-- /row -->';}
      ?>
     <!--  <div class="col-md-3 profile-info">
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
      </div> --> 
  <?php require_once 'includes/footer.php' ?>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/jquery-ui.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/tag-it.min.js"></script>
  <script type="text/javascript" src="js/SearchTags.js"></script>
</body>
</html>
