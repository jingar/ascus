<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-12-31 at 15:29:19.
 */
require_once '/var/www/ascus/classes/validation/ValidatorManager.php';
require_once '/var/www/ascus/classes/validation/RequiredValidator.php';
require_once '/var/www/ascus/classes/validation/AlphaNumericValidator.php';
require_once '/var/www/ascus/classes/validation/MinimumLengthValidator.php';
require_once '/var/www/ascus/classes/validation/AlphaValidator.php';

class ValidatorManagerTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ValidatorManager
     */
    protected $validatorManager;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->validatorManager = new ValidatorManager;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers ValidatorManager::validate
     */
    public function testValidateFirstName() {
        $this->validatorManager = new ValidatorManager;
        $this->validatorManager->addValidator(new RequiredValidator())
                ->addValidator(new AlphaValidator());

        $this->assertEquals(true, $this->validatorManager->validate("bob", "First Name"));
        $this->assertEquals(false, $this->validatorManager->validate("  ", "First Name"));
        $this->assertEquals(false, $this->validatorManager->validate("bob1", "First Name"));
        $this->assertEquals(false, $this->validatorManager->validate("bob ", "First Name"));
    }

    /**
     * @covers ValidatorManager::validate
     */
    public function testValidateUsername() {
        $this->validatorManager->addValidator(new RequiredValidator())
                ->addValidator(new AlphaValidator());

        $this->assertEquals(false, $this->validatorManager->validate("bob12", "First Name"));
        $this->assertEquals(false, $this->validatorManager->validate("     ", "First Name"));
        $this->assertEquals(false, $this->validatorManager->validate("bob bpb", "First Name"));
        $this->assertEquals(true, $this->validatorManager->validate("bob", "First Name"));
    }

    /**
     * @covers ValidatorManager::validate
     */
    public function testValidatePassword() {
        $this->validatorManager->addValidator(new RequiredValidator())
                ->addValidator(new AlphaNumericValidator())
                ->addValidator(new MinimumLengthValidator(5));

        $this->assertEquals(false, $this->validatorManager->validate("pass 1", "First Name"));
        $this->assertEquals(false, $this->validatorManager->validate("  ", "First Name"));
        $this->assertEquals(false, $this->validatorManager->validate("bob bpb", "First Name"));
        $this->assertEquals(true, $this->validatorManager->validate("bob12", "First Name"));
    }

}