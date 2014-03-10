

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
class WorkSample {

    private $_database_connection;

    public function __construct() {
        $this->_database_connection = Database::getInstance();
    }

    public function addWorkSample($fields)
    {
        var_dump($fields);
    	$this->_database_connection->query("INSERT into `work_samples`
    		VALUES (?,?, ?, ?, ?,?)",$fields);
    }
    public function findByMemberID($memberID)
    {
        $this->_database_connection->query("SELECT * from `work_samples` WHERE `members_id` = ?",
            $memberID);
        return $this->_database_connection->getResults();
    }

    public function delete($memberID)
    {
        $this->_database_connection->query("DELETE from work_samples WHERE work_samples_id = ?",
            array($memberID));
    }
}


