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

    public function findByExpertise($expertise)
    {
        $result = $this->_database_connection->find("area_of_expertise", "expertise", $expertise);
        return (empty($result)) ? $result : $result[0];
    }

    public function addExpertise($expertise) {
        if(is_array($expertise))
        {
            foreach ($expertise as $e) {
                $this->_database_connection->query("INSERT INTO `area_of_expertise` (`expertise`)"
                    . " VALUES (?) ON DUPLICATE KEY UPDATE `expertise` = ?",array($e,$e));
            }
        }
    }

}
