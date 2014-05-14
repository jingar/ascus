<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Expertise
 *
 * @author Saad Arif 
 */
class Expertise {

    private $_database_connection;

    public function __construct() {
        $this->_database_connection = Database::getInstance();
    }
    public function findByID($expertise_id)
    {
        $result = $this->_database_connection->find("area_of_expertise", "expertise_id", $expertise_id);
        return (empty($result)) ? $result : $result[0];
    }

    public function findByExpertise($expertise)
    {
        $result = $this->_database_connection->find("area_of_expertise", "expertise", $expertise);
        return (empty($result)) ? $result : $result[0];
    }
    
    public function findByExpertiseMultiple($expertise_array)
    {
        $result_array = array();
        if(!empty($expertise_array) && is_array($expertise_array))
        {
            foreach ($expertise_array as $expertise) {
                $result = $this->findByExpertise($expertise);
                if($result)
                {
                    $result_array [] = $result;
                }
            }
        }
        return $result_array;
    }

    public function findAllExpertise()
    {
        $this->_database_connection->query("SELECT * from `area_of_expertise`");
        return $this->_database_connection->getResults();
    }
    
    public function findAllExpertiseNames()
    {
        $this->_database_connection->query("SELECT `expertise` from `area_of_expertise`");
        return $this->_database_connection->getResults();
    }

    public function addExpertise($expertise) {
        if(!empty($expertise) && is_array($expertise))
        {
            foreach ($expertise as $e) {
                $this->_database_connection->query("INSERT INTO `area_of_expertise` (`expertise`)"
                    . " VALUES (?) ON DUPLICATE KEY UPDATE `expertise` = ?",array($e,$e));
            }
        }
    }
    public function findMembersByExpertise($expertise)
    {
        $result = $this->findByExpertise($expertise);
        if(!empty($result))
        {
            $query = "select members.members_id,profession,name,city,country,
            profile_pic,personal_site from members
            inner join (select members_id from members_area_of_expertise where expertise_id = ?) ids
            on members.members_id = ids.members_id";
            $this->_database_connection->query($query,array($result->expertise_id));
            return $this->_database_connection->getResults();
        }

    }
}
