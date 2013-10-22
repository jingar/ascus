<?php
	require_once('./php/connect-inc.php');
	class Member
	{
		private $db_conn;
		private $first_name;
		private $last_name;
		private $email;
		private $city;
		private $country;
		private $phone_number;
		private $username;
		private $password;
		private $error;
		
		function __consrtuct($db,$username)
		{
			$this->db_conn = $db;
			$this->username = $username;
		}
		function __construct($db, $data = array())
		{
			$this->db_conn = $db;
			if(isset($data['first_name'])) {$this->first_name = $data['first_name'];}
			if(isset($data['last_name'])) {$this->last_name = $data['last_name'];}
			if(isset($data['email'])) {$this->email = $data['email'];}
			if(isset($data['city'])) {$this->city = $data['city'];}
			if(isset($data['country'])) {$this->country = $data['country'];}
			if(isset($data['phone_number'])) {$this->phone_number = $data['phone_number'];}
			if(isset($data['username'])) {$this->username = $data['username'];}
			if(isset($data['password'])) {$this->password = $data['password'];}
		}
		function register()
		{	
			$sql = "INSERT INTO members (first_name, last_name, email, city, country, phone_number, username, password)
					VALUES(:first_name, :last_name, :email, :city, :country, :phone_number, :username, :password)";
			$hashed_password = password_hash($this->password,PASSWORD_DEFAULT);
			$prepared_statement = $this->db_conn->prepare($sql);
			$prepared_statement->bindParam(':first_name', $this->first_name, PDO::PARAM_STR);
			$prepared_statement->bindParam(':last_name', $this->last_name, PDO::PARAM_STR);
			$prepared_statement->bindParam(':email', $this->email, PDO::PARAM_STR);
			$prepared_statement->bindParam(':city', $this->city, PDO::PARAM_STR);
			$prepared_statement->bindParam(':country', $this->country, PDO::PARAM_STR);
			$prepared_statement->bindParam(':phone_number', $this->phone_number, PDO::PARAM_STR);
			$prepared_statement->bindParam(':username', $this->username, PDO::PARAM_STR);
			$prepared_statement->bindParam(':password', $hashed_password, PDO::PARAM_STR);
			$prepared_statement->execute();
			
		}
		function authenticate()
		{
			$sql = "SELECT password FROM members WHERE username = :username";
			// prepare statement
			$prepared_statement = $this->db_conn->prepare($sql);
			// bind the input parameter
			$prepared_statement->bindParam(':username', $this->username, PDO::PARAM_STR);
			// bind the result, using a new variable for the password
			$prepared_statement->bindColumn(1, $stored_password);
			$did_execute = $prepared_statement->execute();
			if(!$did_execute)
			{
				echo "did not execute";
				return false;
			}
			$found_username = $prepared_statement->fetch();
			if(!$found_username)
			{
				echo "could not find user name";
				return false;
			}
			if (!password_verify($this->password, $stored_password))
			{
				echo "password incorrect";
				return false;
			}
			return true;
			
		}
		function login()
		{
			if(!$this->authenticate())
			{
				return false;
			}
			$_SESSION['authenticated'] = true;
			// get the time the session started
			$_SESSION['start'] = time();
			session_regenerate_id();
			return true;
		}
		
	
	}

?>