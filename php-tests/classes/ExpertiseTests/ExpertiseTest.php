<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExpertiseTest
 *
 * @author Saad Arif 
 */
require_once '/var/www/ascus/php/Database.php';
require_once '/var/www/ascus/php/Expertise.php';
require_once '/var/www/ascus/php-tests/php/PHPUnit_Extensions_Database_Operation_MySQL55Truncate.php';

class ExpertiseTest extends PHPUnit_Extensions_Database_TestCase {

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

    public function testAddExpertise() {
        $database = new Database("write");
        $database_connection = $database->connect();
        $expertise = new Expertise($database_connection);
        $expertise_array = array("web development", "drawing");
        $expertise->addExpertise($expertise_array);
        $duplicate_array = array("web development", "drawing");
        $expertise->addExpertise($duplicate_array);
        $queryTable = $this->getConnection()->createQueryTable(
                'area_of_expertise', 'SELECT expertise FROM area_of_expertise '
                . 'ORDER BY expertise_id'
        );
        $expectedTable = $this->createXmlDataSet("ExpectedDataAddExpertise.xml")
                ->getTable("area_of_expertise");
        $this->assertTablesEqual($expectedTable, $queryTable);
    }

}
