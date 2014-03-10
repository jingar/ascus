<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
session_start();
ob_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'saad_admin',
        'password' => '=8@^+W+&1P,LbR$',
        'db' => 'saad_ascus_scratch'
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'csrf_token')
);


spl_autoload_register(function ($class) {
    $classMap = array(
        'classes/',
        'classes/validation/'
    );
    foreach ($classMap as $location) {
        if (file_exists(dirname(__DIR__) . '/' . $location . $class . '.php')) {
            require_once (dirname(__DIR__) . '/' . $location . $class . '.php');
            break;
        }
    }
});

require_once 'classes/upload/class.upload.php';