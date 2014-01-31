<?php

require_once 'Database.php';
require_once 'Mailer.php';

class Member {

    private $database_connection;

    public function __construct($database_connection) {
        $this->database_connection = $database_connection;
    }

    function register($name, $email, $username, $password, $country = 'NULL', $city = 'NULL') {
        $query = "INSERT INTO members (name, email, username, password, country, city, confirmation_key, status)
			    VALUES(:name, :email, :username, :password, :country, :city, :confirmation_key ,:status)";
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($hashed_password === FALSE) {
            throw new RuntimeException("Hashing password when registering failed");
        }
        $confirmation_key = substr(password_hash(uniqid(rand(), TRUE), PASSWORD_DEFAULT), 0, 20);
        if ($hashed_password === FALSE) {
            throw new RuntimeException("Creating confrimation key when registering failed");
        }

        $prepared_statement = $this->database_connection->prepare($query);
        $prepared_statement->bindParam(':name', $name, PDO::PARAM_STR);
        $prepared_statement->bindParam(':email', $email, PDO::PARAM_STR);
        $prepared_statement->bindParam(':city', $city, PDO::PARAM_STR);
        $prepared_statement->bindParam(':country', $country, PDO::PARAM_STR);
        $prepared_statement->bindParam(':username', $username, PDO::PARAM_STR);
        $prepared_statement->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $prepared_statement->bindParam(':confirmation_key', $confirmation_key, PDO::PARAM_STR);
        $default_status = 0; //false
        $prepared_statement->bindParam(':status', $default_status, PDO::PARAM_INT);
        $prepared_statement->execute();

        Mailer::send_mail($name, $email, $confirmation_key);
    }

    function login($username, $password) {
        $stored_password = NULL;
        //look the user with the username and an activated account
        $query = "SELECT password FROM members WHERE username = :username AND status = 1";
        $prepared_statement = $this->database_connection->prepare($query);
        $prepared_statement->bindParam(':username', $username, PDO::PARAM_STR);
        $prepared_statement->bindColumn(1, $stored_password);
        $did_execute = $prepared_statement->execute();
        if (!$did_execute) {
            throw new RuntimeException("Could not execute query when authenticating");
        }

        $found_username = $prepared_statement->fetch();
        if ($found_username === NULL) {
            throw new RuntimeException("Error fetching row when authenticating");
        } else if ($found_username === FALSE) {
            return FALSE;
        }

        if (!password_verify($password, $stored_password)) {
            return false;
        }
        $_SESSION['authenticated'] = true;
        $_SESSION['start'] = time();
        session_regenerate_id();
        return true;
    }

    public function isAccountActivated($username) {
        $status = NULL;
        $query = "SELECT `status` FROM `members` WHERE `username` = :username";
        $prepared_statement = $this->database_connection->prepare($query);
        $prepared_statement->bindParam(':username', $username, PDO::PARAM_STR);
        $prepared_statement->bindColumn(1, $status);
        $did_execute = $prepared_statement->execute();
        if (!$did_execute) {
            throw new RuntimeException("isAccountActiviated: Could not execute query when checking");
        }
        if ($status === 0) {
            return false;
        }
        return true;
    }

}

?>