<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hash
 *
 * @author Saad Arif 
 */
class Hash {

    public static function generate($value) {
        $result = password_hash($value, PASSWORD_DEFAULT);
        if ($result === FALSE) {
            throw new RuntimeException("Hash could not be generated");
        }
        return $result;
    }

    public static function check($value, $hash) {
        return password_verify($value, $hash);
    }

    public static function generateUniqueNumber() {
        
        $unique = static::generate(uniqid(rand(), TRUE), PASSWORD_DEFAULT);
        $length = strlen($unique);
        //unique number length is 20
        $result = substr($unique,$length-20,$length);
        return $result;
    }

}
