<?php
class MemberExpertise
{

	private $_database_connection;

	public function __construct() {
		$this->_database_connection = Database::getInstance();
	}

	public function findByMemberId($membersId)
	{
		$result = $this->_database_connection->find("members_area_of_expertise", "members_id", $members_id);
		return (empty($result)) ? $result : $result[0];
	}

	public function deleteAllByExpertiseId($expertisIds)
	{
		foreach ($expertisIds as $expertiseId) {
			$this->_database_connection->query("DELETE FROM `members_area_of_expertise` WHERE `expertise_id` = ?"
				,array($expertiseId));
		}
	}
	public function findAllMemberExpertise($membersId)
	{
		$query = "SELECT area_of_expertise.* from area_of_expertise INNER JOIN
		members_area_of_expertise on members_area_of_expertise.expertise_id = area_of_expertise.expertise_id
		WHERE members_area_of_expertise.members_id = ?";
		$this->_database_connection->query($query,array($membersId));
		return $this->_database_connection->getResults();
	}

	public function addMemberExpertise($members_id,$expertiseId)
	{
		$this->_database_connection->query("REPLACE INTO `members_area_of_expertise` 
			(`members_id`,`expertise_id`) VALUES (?,?)",array($members_id,$expertiseId));
	}
}