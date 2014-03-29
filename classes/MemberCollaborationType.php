<?php
class MemberCollaborationType
{

	private $_database_connection;

	public function __construct() {
		$this->_database_connection = Database::getInstance();
	}

	public function addMemberCollaborationType($membersId,$collaborationTypeId)
	{
		$this->_database_connection->query("REPLACE INTO `members_collaboration_types` 
			(`members_id`,`collaboration_type_id`) VALUES (?,?)",array($membersId,$collaborationTypeId));
	}

	public function FindAllMemberCollaborationTypes($membersId)
	{
		$query = "SELECT collaboration_types.collaboration_type from collaboration_types INNER JOIN
		members_collaboration_types on 
		members_collaboration_types.collaboration_type_id = collaboration_types.collaboration_type_id
		WHERE members_collaboration_types.members_id = ?";

		$this->_database_connection->query($query,array($membersId));

		return $this->_database_connection->getResults();
	}

	public function deleteAll($membersId)
	{
		$this->_database_connection->query("DELETE from `members_collaboration_types` WHERE `members_id` = ?",
			array($membersId));
	}

}
