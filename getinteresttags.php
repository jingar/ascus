<?php 

require_once 'core/init.php';
$member = new Member(Input::get('id'));
$memberExpertise = new MemberExpertise();
$interest = new Interest();
$allInterests = $interest->findAllInterests(array($member->getData()->members_id));
$tags = array();
foreach($allInterests as $i)
{
	$tags [] = $i->interest;
}

echo json_encode($tags);
?> 