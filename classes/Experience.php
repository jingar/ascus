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
class Experience {

    private $_database_connection;

    public function __construct() {
        $this->_database_connection = Database::getInstance();
    }

    public function deleteAll($membersId)
    {
        $this->_database_connection->query("DELETE from `experiences` WHERE `members_id` = ?",array($membersId));
    }
    public function findAllExperiences($membersId)
    {
        $this->_database_connection->query("SELECT `work_project_name`, `link` from `experiences` WHERE `members_id` = ?",
            array($membersId));
        return $this->_database_connection->getResults();
    }

    public function addExperiences($membersId,$experiences) {
        if(!empty($experiences) && is_array($experiences))
        {
            foreach ($experiences as $exp) {
                $this->_database_connection->query("INSERT INTO `experiences` (`members_id`,`work_project_name`,`link`) VALUES (?,?,?)",
                    array($membersId,$exp['work_project'],$exp['link']));
            }
        }
    }

}
