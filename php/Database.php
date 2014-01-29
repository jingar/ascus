<?php

class Database {

    private $host;
    private $database_name;
    private $user;
    private $password;

    public function __construct($usertype) {
        $this->host = "localhost";
        $this->database_name = "saad_ascus_scratch";
        if ($usertype == 'read') {
            $this->user = 'saad_ascusRead';
            $this->password = ')o}3^X#~Lz4lUh(9Kd';
        } elseif ($usertype == 'write') {
            $this->user = 'saad_ascusWrite';
            $this->password = '_+EOf2+G.K^Hf8+';
        } else {
            throw new InvalidArgumentException("Invalid User Type");
        }
    }

    public function connect() {
        try {
            $connection = new PDO("mysql:host=$this->host;dbname=$this->database_name", $this->user, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo "error database connect";
            throw $e;
        }
    }
 
            

}
