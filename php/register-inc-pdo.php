<?php

require_once('./php/validation/ValidatorManager.php');
require_once('./php/validation/AlphaNumericValidator.php');
$errors = array();

// First name cannot be empty and must only be letters
$firstNameValidator = new ValidatorManager();
//$firstNameValidator->addValidator(new )
$firstNameValidator->validate($_POST['first_name']);
$errors = array_merge($errors, $firstNameValidator->getErrors());

// Last name cannot be empty and must only be letters

//email, email validator

//phone number, only numeric

//username unique,alphanumeric

//password alphanumeric and one uppercase 7

//confirm password , matches password

if (!$errors) {
    echo "success";
    /* try */
    /*   { */
    /* 	require_once('./php/connect-inc.php'); */
    /* 	require_once('./php/user-inc.php'); */
    /* 	$connMember = dbConnect('write', 'pdo'); */
    /* 	$connMember ->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); */
    /* 	$member = new Member($connMember ,$_POST); */
    /* 	$member->register(); */
    /*   } */
    /* catch( Exception $e) */
    /*   { */
    /* 	echo 'Caught exception: ' . $e->getMessage() . '\n'; */
    /*   }		 */

    /* if ()
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
      } */
}
?>