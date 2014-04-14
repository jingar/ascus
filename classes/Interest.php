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

    public function findByInterest($interest)
    {
        $result = $this->_database_connection->find("interests", "interest", $interest);
        return (empty($result)) ? $result : $result[0];
    }
    public function findMembersByInterest($interest)
    {
        $result = $this->findByInterest($interest);
        if(!empty($result))
        {
            $query = "select members.members_id,profession,name,city,country,profile_pic from members
            inner join (select members_id from interests where interest = ?) ids
            on members.members_id = ids.members_id";
            $this->_database_connection->query($query,array($result->interest));
            return $this->_database_connection->getResults();
        }

    }
}



