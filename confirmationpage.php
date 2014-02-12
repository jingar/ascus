<?php
require_once './core/init.php';
if (Input::exists('get')){
    try {
        $member = new Member();
        $member->activateAccount(array(Input::get('email'),Input::get('confirmation_key')));
        Session::flash('Email Activated', "Your account has been activiated you may now login");
        Redirect::to('homepage.php');
    } 
    catch (Exception $ex) {
        Session::flash('Email Not Activated', "Your account could not be activiated");
        Redirect::to('homepage.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Ascus</title>
    </head>
    <body>
    </body>
</html>
