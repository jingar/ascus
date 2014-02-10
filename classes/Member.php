<?php

class Member {
    private $_database_connection = NULL,
            $_data = NULL,
            $_isLoggedIn = FALSE;

    public function __construct($user = NULL) {
        $this->_database_connection = Database::getInstance();
        if (!$user) {
            if (Session::exists(Config::get('session/session_name'))) {
                $user = Session::get(Config::get('session/session_name'));
                if ($this->_database_connection->rowExists('members_id',$user)) {
                    $this->_data = $this->findByID($user);
                    $this->_isLoggedIn = TRUE;
                }
                else
                {
                    $this->logOut();
                }
            }
        }
        else
        {
            $this->_data = $this->findByUsername($username);
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
        $this->_database_connection->query("UPDATE `members` SET `status` = 0 WHERE `confirmation_key` = ?"
            . " AND `email` = ?",$fields);
    }
    
    public function isAccountActivated($username) {
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