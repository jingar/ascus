<?php
require_once './core/init.php';

if (Input::exists('get')){
    try {
        $user = new User();
        $user->activateAccount(array(Input::get('email'),Input::get('confirmationKey')));
        Session::flash('Email Activated', "Your account has been activiated you may now login");
        Redirect::to('homepage.php');
    } 
    catch (Exception $ex) {
        Session::flash('Email Not Activated', "Your account could not be activiated");
        Redirect::to('homepage.php');
    }
}
?>