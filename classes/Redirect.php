<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Redirect
 *
 * @author Saad Arif 
 */
class Redirect {

    public static function to($location = NULL) {
        if ($location !== NULL) {
            if (is_numeric($location)) {
                switch ($location) {
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        include 'error/404.html';
                        exit();
                }
            }
            header('Location: ' . $location);
            exit();
        }
    }

}
