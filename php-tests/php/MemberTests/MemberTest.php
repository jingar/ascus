<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemberTest
 *
 * @author Saad Arif 
 */
require_once '/var/www/ascus/php/Database.php';
require_once '/var/www/ascus/php/Member.php';
require_once '/var/www/ascus/php-tests/php/PHPUnit_Extensions_Database_Operation_MySQL55Truncate.php';

class MemberTest extends PHPUnit_Extensions_Database_TestCase {

    public function getSetUpOperation() {
        $cascadeTruncates = TRUE; //if you want cascading truncates, false otherwise
        //if unsure choose false

        return new PHPUnit_Extensions_Database_Operation_Composite(array(
            new PHPUnit_Extensions_Database_Operation_MySQL55Truncate($cascadeTruncates),
            PHPUnit_Extensions_Database_Operation_Factory::INSERT()
        ));
    }

    public function getConnection() {
        $database = new Database("write");
        $database_connection = $database->connect();
        $database_name = 'saad_ascus_scratch';
        return $this->createDefaultDBConnection($database_connection, $database_name);
    }

    public function getDataSet() {
        return $this->createXMLDataSet(dirname(__FILE__) . '/InitialData.xml');
    }

    public function testRegister() {
        $database = new Database("write");
        $database_connection = $database->connect();
        $member = new Member($database_connection);
        $member->register("saad", "saad1@gmail.com", "saad1234", "12345");
        $member->register("fahad", "fahad@gmail.com", "fahad123", "12345","scotland","edinburgh");
        $queryTable = $this->getConnection()->createQueryTable(
                'members', 'SELECT name,email,username,country,city,status FROM members'
        );
        $expectedTable = $this->createXmlDataSet("ExpectedData.xml")
                ->getTable("members");
        $this->assertTablesEqual($expectedTable, $queryTable);
    }

}
