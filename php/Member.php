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
        if ($hashed_password === false) {
            throw new RuntimeException("Storing password failed");
        }
        $confirmation_key = substr(password_hash(uniqid(rand(), true), PASSWORD_DEFAULT), 0, 20);
        if ($hashed_password === false) {
            throw new RuntimeException("Creating key failed");
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
        $prepared_statement->bindParam(':status', $default_status, PDO::PARAM_BOOL);
        $prepared_statement->execute();

        Mailer::send_mail($name, $email, $confirmation_key);
    }

    function authenticate() {
        $sql = "SELECT password FROM members WHERE username = :username";
        // prepare statement
        $prepared_statement = $this->db_conn->prepare($sql);
        // bind the input parameter
        $prepared_statement->bindParam(':username', $this->username, PDO::PARAM_STR);
        // bind the result, using a new variable for the password
        $prepared_statement->bindColumn(1, $stored_password);
        $did_execute = $prepared_statement->execute();
        if (!$did_execute) {
            echo "did not execute";
            return false;
        }
        $found_username = $prepared_statement->fetch();
        if (!$found_username) {
            echo "could not find user name";
            return false;
        }
        if (!password_verify($this->password, $stored_password)) {
            echo "password incorrect";
            return false;
        }
        return true;
    }

    function login() {
        if (!$this->authenticate()) {
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