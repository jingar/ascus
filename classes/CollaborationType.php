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
class CollaborationType {

	private $_database_connection;

	public function __construct() {
		$this->_database_connection = Database::getInstance();
	}

	public function findCollaborationID($CollaborationType)
	{
		$this->_database_connection->query("SELECT collaboration_type_id from `collaboration_types` 
			WHERE collaboration_type = ?",array($CollaborationType));
		return $this->_database_connection->getResults()[0];
	}

}
