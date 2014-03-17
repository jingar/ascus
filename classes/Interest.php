<?php

/*
 * To change this license headetr, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Expertise
 *
 * @author Saad Arif 
 */
class Interest {

    private $_database_connection;
    public function __construct() {
        $this->_database_connection = Database::getInstance();
    }

    public function addInterest($fields)
    {
    	$this->_database_connection->query("REPLACE INTO `interests`(members_id,interest) VALUES (?,?)",$fields);
    }

    public function deleteAll($field)
    {
        $this->_database_connection->query("DELETE from interests WHERE members_id = ?",$field);
    }

    public function findAllInterests($field)
    {
    	$this->_database_connection->query("SELECT interest from interests where members_id = ?" , $field);
        return $this->_database_connection->getResults();
    }
}



