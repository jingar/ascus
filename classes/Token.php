<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Token
 *
 * @author Saad Arif 
 */
class Token {

    public static function generate() {
        return Session::put(Config::get('session/token_name'), substr(password_hash(uniqid(rand(), TRUE), PASSWORD_DEFAULT), 16, 32));
    }

    public static function check($token) {
        $tokenName = Config::get('session/token_name');
        if (Session::exists($tokenName) && $token == Session::get($tokenName)) {
            Session::delete($tokenName);
            return TRUE;
        }
        return FALSE;
    }

}
