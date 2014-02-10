<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailValidatorTest
 *
 * @author Saad Arif 
 */
require_once '/var/www/ascus/classes/validation/EmailValidator.php';

class EmailValidatorTest {

    /**
     * @var EmailValidator
     */
    protected $emailValidator;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->emailValidator = new EmailValidator();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers EmailValidator::validate
     */
    public function testValidate() {
        $this->assertEquals(TRUE, $this->emailValidator->validate("saad@gmail.com", ""));
        $this->assertEquals(FALSE, $this->emailValidator->validate("blah.com ", ""));
    }

}
