<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EqualValidator
 *
 * @author Saad Arif 
 */
class EqualValidator extends Validator {

    private $_confrimValue;
    private $_originalField;

    public function __construct($confirmValue, $originalField) {
        $this->_confrimValue = $confirmValue;
        $this->_originalField = $originalField;
    }

    public function validate($value, $fieldName) {
        if ($value !== $this->_confrimValue) {
            $this->errors [] = "$fieldName should be equal $this->_originalField";
                return false;
            }
        return true;
    }

}
