<?php

class Member {
    private $_database_connection = NULL,
            $_data = NULL,
            $_isLoggedIn = FALSE;

    public function __construct($user = NULL) {
        $this->_database_connection = Database::getInstance();
        echo 'member constructor';
        if (!$user) {
            if (Session::exists(Config::get('session/session_name'))) {
                echo 'if sessions exists';
                $user = Session::get(Config::get('session/session_name'));
                if ($this->_database_connection->rowExists('members_id',$user)) {
                    $this->_data = $this->findByID($user);
                    $this->_isLoggedIn = TRUE;
                }
                else
                {   echo 'member constructor logout';
                    $this->logOut();
                }
            }
        }
        else
        {
            echo 'member constructor id passed';
            $this->_data = $this->findByUsername($user);
        }
    }

    public function findByUsername($username) {
        $result = $this->_database_connection->find("members", "username", $username);
        return (empty($result)) ? $result : $result[0];
    }

    public function findByID($members_id) {
        $result =  $this->_database_connection->find("members", "members_id", $members_id);
        return (empty($result)) ? $result : $result[0];
    }

    public function findByEmail($email) {
        $result = $this->_database_connection->find("members", "email", $email);
        return (empty($result)) ? $result : $result[0];
    }

    //name, profession ,email, username, password , city ,country, confirmation key, account status
    // bio
    public function register($fields)
    {
        $this->_database_connection->query("INSERT into `members`
            (name, profession, email, username, password, city, country, confirmation_key, status,bio) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",$fields);
        
    }
    public function login($username = NULL, $password = NULL) {
        echo 'login';
        if ($this->_database_connection->rowExists("username", $username)) {
            $user = $this->findByUsername($username);
            if (Hash::check($password, $user->password)) {
                return true;
            }
        }
        return false;

    }

    public function logOut(){
        Session::delete(Config::get('session/session_name'));
    }

    public function activateAccount($fields)
    {
        array_unshift($fields, "1");
        var_dump($fields);
        $this->_database_connection->query("UPDATE `members` SET `status` = ? WHERE `email` = ?"
            . " AND `confirmation_key` = ?",$fields);
    }
    
    public function isAccountActivated($username) {
        echo 'is account activiated';
        $user = $this->findByUsername($username);
        if (!empty($user)) {
            if ($user->status !== "0") {
                return true;
            }
        }
        return false;
    }

    public function editProfile($fields,$id = NULL) {
        if(!$id)
        {
            $fields['members_id'] = $this->_data->members_id;   
        }
        $this->_database_connection->query("UPDATE `members` SET `name` = ?, `city` = ? WHERE `members_id` = ?", $fields);
    }   

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }

    public function getData(){
        return $this->_data;
    }
}

?>