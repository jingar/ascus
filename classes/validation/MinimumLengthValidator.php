<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MinimumLengthValidator
 *
 * @author Saad Arif 
 */

require_once "Validator.php";

class MinimumLengthValidator extends Validator {

    private $minimumLength;

    public function __construct($minimumLength) {
        $this->minimumLength = $minimumLength;
    }

    public function validate($value,$fieldName) {
        if (strlen($value) < $this->minimumLength) {
            $this->errors [] = "$fieldName length must be greater than $this->minimumLength";
            return false;
        }
        return true;
    }

//put your code here
}
