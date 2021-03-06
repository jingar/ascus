<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-12-29 at 20:14:41.
 */
require_once '/var/www/ascus/classes/validation/AlphaNumericValidator.php';

class AlphaNumericValidatorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var AlphaNumericValidator
     */
    protected $alphaNumeric;

    protected function setUp() {
        $root = realpath(filter_input(INPUT_SERVER, "DOCUMENT_ROOT"));
        print_r("root: " . $root . "\n");
        print_r("__DIR__".__DIR__."\n");
        $this->alphaNumeric = new AlphaNumericValidator("First Name");
    }

    protected function tearDown() {
        
    }

    /**
     * @covers AlphaNumericValidator::validate
     */
    public function testValidate() {

        $this->assertEquals(true, $this->alphaNumeric->validate("A1",""));
        $this->assertEquals(true, $this->alphaNumeric->validate("z0Z",""));
        $this->assertEquals(false, $this->alphaNumeric->validate("1 1",""));
        $this->assertEquals(false, $this->alphaNumeric->validate("1!A",""));
    }

}
