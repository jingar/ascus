<?php

require_once 'core/init.php';
$expertise = new Expertise();
$allExpertise = $expertise->findAllExpertiseNames();
$tags = array();
foreach($allExpertise as $expertise)
{
	$tags [] = $expertise->expertise;
}

$interest = new Interest();

$allInterests = $interest->findAllInterestNames();

foreach($allInterests as $interest)
{
	$tags [] = $interest->interest;
}


echo json_encode($tags);

?>