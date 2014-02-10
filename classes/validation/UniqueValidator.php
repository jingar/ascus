<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UniqueValidator
 *
 * @author Saad Arif 
 */
class UniqueValidator extends Validator {

    private $_databaseConnection;
    private $_sqlQuery = NULL;

    public function __construct($type) {
        $this->_databaseConnection = Database::getInstance();
        if ($type === 'email') {
            $this->_sqlQuery = "SELECT `email` FROM `members` WHERE `email` = ?";
        } else if ($type === 'username') {
            $this->_sqlQuery = "SELECT `username` FROM `members` WHERE `username` = ?";
        }
    }

    public function validate($value, $fieldName) {

        $this->_databaseConnection->query($this->_sqlQuery, array($value));
        if (!empty($this->_databaseConnection->getResults())) {
            $this->errors[] = "$fieldName is already taken";
            return false;
        }
        return true;
    }

}
