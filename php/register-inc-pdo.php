<?php
	require_once('./php/validator-inc.php');
	$errors = array();
	
	$firstNameValidator = new Validator($_POST['first_name'],"First name");
	$firstNameValidator->requireMinimumChars(1);
	$firstNameValidator->requireAlpha();
	$firstNameValidator->check();
	$errors = array_merge($errors,$firstNameValidator->getErrors());
	
	$lastNameValidator = new Validator($_POST['last_name'],"Last name");
	$lastNameValidator->requireMinimumChars(1);
	$lastNameValidator->requireAlpha();
	$lastNameValidator->check();
	$errors = array_merge($errors,$lastNameValidator->getErrors());
	
	
	$emailValidator = new Validator($_POST['email'],"Email");
	$emailValidator ->requireNotBlank();
	$emailValidator ->requireValidationAsEmail();
	$emailValidator ->check();
	$errors = array_merge($errors,$emailValidator ->getErrors());
	
	$usernameValidator = new Validator($_POST['username'],"Username");
	$usernameValidator ->requireNotBlank();
	$usernameValidator ->requireMinimumChars(5);
	$usernameValidator ->check();
	$errors = array_merge($errors,$usernameValidator ->getErrors());
	
	$passwordValidator= new Validator($_POST['password'],"Password");
	$passwordValidator->requireNotBlank();
	$passwordValidator->requireMinimumChars(5);
	$passwordValidator->requireMixedCase();
	$passwordValidator->requireAlphaNumeric();
	$passwordValidator->check();
	$errors = array_merge($errors,$passwordValidator->getErrors());

	if($password !== $confirm_password)
	{
		$errors[] = "password confirmation does not match password";
	}
	
	if(!$errors)
	{
		echo "success";
		try
		{
			require_once('./php/connect-inc.php');
			require_once('./php/user-inc.php');
			$connMember = dbConnect('write', 'pdo');
			$connMember ->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$member = new Member($connMember ,$_POST);
			$member->register();
		}
		catch( Exception $e)
		{
			echo 'Caught exception: ' . $e->getMessage() . '\n';
		}		
		
		/*if ()
		{
			$conn_profile = dbConnect('write', 'pdo');
			//once the memeber has been inserted then add a profile for the member
			$sql_profile = "INSERT INTO profile+ (user_id,artist_interests,scientific_interests,description)
					VALUES (:user_id,:artist_interests,:scientific_interests,:description)";
			//prepare statement using the new connection
			$prepared_statement_profile = $conn_profile->prepare($sql_profile);
			//get the member id of last registered member 
			$last_member_id = $conn_member->lastInsertId('user_id');
			$null = NULL;
			$prepared_statement_profile->bindParam(':user_id',$last_member_id,PDO::PARAM_INT);
			$prepared_statement_profile->bindParam(':artist_interests',$null,PDO::PARAM_INT);
			$prepared_statement_profile->bindParam(':scientific_interests',$null,PDO::PARAM_INT);
			$prepared_statement_profile->bindParam(':description',$null,PDO::PARAM_INT);
			header("Location: $redirect");
			exit;
			
		}
		elseif ($prepared_statement->errorCode() == 23000)
		{
			$errors[] = "$username is already in use. Please choose another username.";
		}
		else
		{
			$errors[] = 'Sorry, there was a problem with the database.';
		}*/
	}

?>