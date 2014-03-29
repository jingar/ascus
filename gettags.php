<?php 

require_once 'core/init.php';
$member = new Member(Input::get('id'));
$memberExpertise = new MemberExpertise();
$allMemberExpertise = $memberExpertise->findAllMemberExpertise($member->getData()->members_id);
$tags = array();
$expertise = new Expertise();
foreach($allMemberExpertise as $memberExpertise)
{
	$tags [] = $memberExpertise->expertise;
}

echo json_encode($tags);

?> 