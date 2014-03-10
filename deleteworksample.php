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
$worksample = new WorkSample();
$worksample->delete(Input::get('worksampleid'));
unlink('worksamples/'. Input::get('imagename'));
echo Input::get('imagename');
Redirect::to('showworksamples.php?id=' . Input::get('id'));
?>