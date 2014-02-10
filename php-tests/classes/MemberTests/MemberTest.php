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
require_once '/var/www/ascus/core/init.php';
require_once '/var/www/ascus/php-tests/PHPUnit_Extensions_Database_Operation_MySQL55Truncate.php';

class MemberTest extends PHPUnit_Extensions_Database_TestCase {

    public function getSetUpOperation() {
        $cascadeTruncates = TRUE; //if you want cascading truncates, FALSE otherwise
        //if unsure choose FALSE

        return new PHPUnit_Extensions_Database_Operation_Composite(array(
            new PHPUnit_Extensions_Database_Operation_MySQL55Truncate($cascadeTruncates),
            PHPUnit_Extensions_Database_Operation_Factory::INSERT()
        ));
    }

    public function getConnection() {
        $database_connection = Database::getInstance();
        $database_name = 'saad_ascus_scratch';
        return $this->createDefaultDBConnection($database_connection->getPDO(), $database_name);
    }

    public function getDataSet() {
        return $this->createXMLDataSet(dirname(__FILE__) . '/InitialData.xml');
    }

    public function testRegister() {
        $member = new Member();
        $member->register(array("saads", "artist", "saad1@gmail.com", "saad1234", "12345", NULL, NULL, Hash::generateUniqueNumber(), 0));
        $member->register(array("fahad", "scientist", "fahad@gmail.com", "fahad123", "12345", "scotland", "edinburgh", Hash::generateUniqueNumber(), 0));
        $queryTable = $this->getConnection()->createQueryTable(
                'members', 'SELECT name,profession,email,username,country,city,status FROM members'
        );
        $expectedTable = $this->createXmlDataSet("ExpectedDataRegister.xml")
                ->getTable("members");
        $this->assertTablesEqual($expectedTable, $queryTable);
    }


    public function testLogin() {
        $member = new Member();
        $member->register(array("saads", "artist", "saad1@gmail.com", "saad1234", Hash::generate("12345"), NULL, NULL, Hash::generateUniqueNumber(), 0));
        $this->assertEquals(TRUE, $member->login("saad1234", "12345"));
        $this->assertEquals(FALSE, $member->login("sadoo", "12345"));
        $this->assertEquals(FALSE, $member->login("saad1234", "password"));
    }

    public function testIsAccountActivated() {
        $member = new Member();
        $member->register(array("saads", "artist", "saad1@gmail.com", "saad1234", Hash::generate("12345"), NULL, NULL, Hash::generateUniqueNumber(), 0));
        $this->assertEquals(FALSE, $member->isAccountActivated("saad1234"));

        $member->register(array("saads", "artist", "saadoo@gmail.com", "saadoo", Hash::generate("12345"), NULL, NULL, Hash::generateUniqueNumber(), 1));
        $this->assertEquals(TRUE, $member->isAccountActivated("saadoo"));
    }

}
