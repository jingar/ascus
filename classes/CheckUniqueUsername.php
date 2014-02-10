<?php
require_once '../core/init.php';
if (Input::exists()) {
    try {
        $member = new Member();
        if(!empty($member->findByUsername(Input::get('username'))))
        {
            echo "false";
            return;
        }
        echo "true";
    } catch (Exception $ex) {
        echo "failed";
    }
}else {
    echo "false";
    return;
}
