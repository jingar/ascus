<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author Saad Arif 
 */
class Config {

    public static function get($path = NULL) {
        if ($path) {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            foreach ($path as $section) {
                if (isset($config[$section])) {
                    $config = $config[$section];
                }
            }
            return $config;
        }
    }

}
