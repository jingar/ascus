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
    
    private function memberExpertiseJoiningTable($members_id,$expertise_id) {
        $query = "INSERT INTO `members_area_of_expertise` (`members_id`,`expertise_id` "
                . "VALUES (:members_id, :expertise_id)";
        $prepared_statement = $this->database_connection->prepare($query);
        $prepared_statement->bindParam(":members_id", $members_id, PDO::PARAM_INT);
        $prepared_statement->bindParam(":expertise_id", $expertise_id, PDO::PARAM_INT);
        $prepared_statement->execute();
    }
    private function lastExpertiseID()
    {
        
    }

    public function addExpertise(array $expertise,$members_id) {
        //update the expertise table with the new expertise tags
        $expertise_query = "INSERT INTO `area_of_expertise` (`expertise`)"
                . " VALUES (:expertise) ON DUPLICATE KEY UPDATE `expertise` = :expertise";
        $expertise_statement = $this->database_connection->prepare($expertise_query);
        foreach ($expertise as $e) {
            echo $e . PHP_EOL;

            $expertise_statement->bindParam(":expertise", $e, PDO::PARAM_STR);
            $output = $expertise_statement->execute();
            $this->memberExpertiseJoiningTable($members_id, )
            echo $output . PHP_EOL;
        }
    }

}
