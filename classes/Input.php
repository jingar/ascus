<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Input
 *
 * @author Saad Arif 
 */
class Input {

    public static function exists($type = 'post') {
        switch ($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
            case 'get':
                return (!empty($_GET)) ? true : false;
            default:
                break;
        }
    }

    public static function valueExists($value,$type = 'post')
    {
        switch ($type) {
            case 'post':
               return (!empty($_POST[$value])) ? true : false;
            case 'get':
               return (!empty($_GET[$value])) ? true : false;
            default:
               break;
        }
    }
    public static function get($item) {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } else if (isset($_GET[$item])) {
            return $_GET[$item];
        } else if (isset($_FILES[$item])) {
            return $_FILES[$item];
        } else {
            return '';
        }
    }

}
