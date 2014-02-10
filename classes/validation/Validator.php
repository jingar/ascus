<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validator
 *
 * @author Saad Arif
 */
abstract class Validator {

    protected $errors = array();

    abstract function validate($value, $fieldName);

    public function getErrors() {

        return $this->errors;
    }

}
