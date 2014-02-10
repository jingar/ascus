<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author Saad Arif 
 */
class Session {

    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function put($name, $value) {
        $_SESSION[$name] = $value;
        return $value;
    }

    public static function get($name) {
        return $_SESSION[$name];
    }

    public static function delete($name) {
        if (static::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function flash($name, $string = '') {
        if (self::exists($name)) {
            $session = static::get($name);
            self::delete($name);
            return $session;
        } else {
            static::put($name, $string);
        }
    }

}
