<?php

class Database {

    private static $_instance = null;
    private $_pdo,
            $_query,
            $_results,
            $_count = 0;

    private function __construct() {
        $this->_pdo = new PDO("mysql:host=" . Config::get('mysql/host')
                . ";dbname=" . Config::get('mysql/db'), Config::get('mysql/username')
                , Config::get('mysql/password'));
        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!isset(static::$_instance)) {
            static::$_instance = new Database();
        }
        return static::$_instance;
    }

    public function query($sql, array $params = array()) {
        $this->_query = $this->_pdo->prepare($sql);
        $position = 1;
        if (count($params)){
            foreach ($params as $param) {
                $this->_query->bindValue($position, $param); // position starts at 1
                ++$position;
            }
        }

        if ($this->_query->execute() === FALSE) {
            throw new RuntimeException("could not execute query in Database->query");
        }
        if ($this->_query->columnCount()) {
            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
        }
        $this->_count = $this->_query->rowCount();
        return $this;
    }

    public function find($table,$column,$value)
    {
        $this->query("SELECT * FROM `{$table}` WHERE `{$column}` = ?",array($value));
        return $this->getResults();
    }
    
    public function rowExists($table,$column, $value)
    {
        $this->find($table, $column, $value);
        if(!empty($this->getResults()))
        {
            return true;
        }
        return false;
    }

    public function getResults() {
        return $this->_results;
    }

    public function count() {
        return $this->_count;
    }
    
    public function getPDO()
    {
        return $this->_pdo;
    }

}
