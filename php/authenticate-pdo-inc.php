<?php
	require_once('./php/connect-inc.php');
	require_once('./php/user-inc.php');
	$conn = dbConnect('read', 'pdo');
	$member = new Member($conn,$_POST);
	if($member->login())
	{
		header("Location: $redirect");
		exit;
	}
	else {
	  echo "did not work";
	}
?>