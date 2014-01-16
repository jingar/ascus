<?php

function dbConnect($usertype, $connectionType = 'mysqli') {
    $host = 'localhost';
    $db = 'saad_ascus_scratch';
    if ($usertype == 'read') {
        $user = 'saad_ascusRead';
        $pwd = ')o}3^X#~Lz4lUh(9Kd';
    } elseif ($usertype == 'write') {
        $user = 'saad_admin';
        $pwd = '_+EOf2+G.K^Hf8+';
    } else {
        exit('Unrecognized connection type');
    }
    if ($connectionType == 'mysqli') {
        return new mysqli($host, $user, $pwd, $db) or die('Cannot open database');
    } else {
        try {
            return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        } catch (PDOException $e) {
            echo 'Cannot connect to database';
            exit;
        }
    }
}

?>