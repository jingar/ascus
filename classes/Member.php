<?php

class Member {
    private $_database_connection = NULL,
            $_data = NULL,
            $_isLoggedIn = FALSE;

    public function __construct($id = NULL) {

        $this->_database_connection = Database::getInstance();
        if (!$id) {
            if (Session::exists(Config::get('session/session_name'))) {
                $id = Session::get(Config::get('session/session_name'));
                if ($this->_database_connection->rowExists('members','members_id',$id)) {
                    $this->_data = $this->findByID($id);
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

            $this->_data = $this->findByID($id);
        }
    }
    public function getAll()
    {
        $this->_database_connection->query("SELECT members_id,profession,name,city,country,
            profile_pic,personal_site from `members`");
        return $this->_database_connection->getResults();
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

    public function findAllByProfession($profession) {
        $this->_database_connection->query("SELECT members_id,profession,name,city,country,
            profile_pic,personal_site from `members` where `profession` = ?",array($profession));
        return $this->_database_connection->getResults();
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
        if ($this->_database_connection->rowExists('members',"username", $username)) {
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
        $this->_database_connection->query("UPDATE `members` SET `status` = ? WHERE `email` = ?"
            . " AND `confirmation_key` = ?",$fields);
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
    public function editMember($fields,$id = NULL) {
        if(!$id){ $fields[] = $this->_data->members_id; }
        $this->_database_connection->query("UPDATE `members` SET `name` = ?, `profession` =?, 
            `city` = ?, `country` = ?,`bio` = ?, `profile_pic` = ?, collaboration_amount = ?,
            `personal_site` = ? WHERE `members_id` = ?", $fields);
    }   

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }

    public function getData(){
        return $this->_data;
    }

}

?>