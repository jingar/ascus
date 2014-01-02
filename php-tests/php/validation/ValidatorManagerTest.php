<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-12-31 at 15:29:19.
 */
require_once '/var/www/ascus/php/validation/ValidatorManager.php';
require_once '/var/www/ascus/php/validation/NonEmptyValidator.php';
require_once '/var/www/ascus/php/validation/AlphaNumericValidator.php';
require_once '/var/www/ascus/php/validation/MinimumLengthValidator.php';
require_once '/var/www/ascus/php/validation/AlphaValidator.php';

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
        $this->validatorManager->addValidator(new NonEmptyValidator("First Name"))
                ->addValidator(new AlphaValidator("First Name"));
        
        $this->assertEquals(true, $this->validatorManager->validate("bob"));
        $this->assertEquals(false, $this->validatorManager->validate("  "));
        $this->assertEquals(false, $this->validatorManager->validate("bob1"));
        $this->assertEquals(false, $this->validatorManager->validate("bob "));
    }

    /**
     * @covers ValidatorManager::validate
     */
    public function testValidateUsername() {
        $this->validatorManager->addValidator(new NonEmptyValidator("First Name"))
                ->addValidator(new AlphaValidator("First Name"));
        
        $this->assertEquals(false, $this->validatorManager->validate("bob12"));
        $this->assertEquals(false, $this->validatorManager->validate("     "));
        $this->assertEquals(false, $this->validatorManager->validate("bob bpb"));
        $this->assertEquals(true, $this->validatorManager->validate("bob"));
    }

    /**
     * @covers ValidatorManager::validate
     */
    public function testValidatePassword() {
        $this->validatorManager->addValidator(new NonEmptyValidator("First Name"))
                ->addValidator(new AlphaNumericValidator("First Name"))
                ->addValidator(new MinimumLengthValidator("First Name", 5));
        
        $this->assertEquals(false, $this->validatorManager->validate("pass 1"));
        $this->assertEquals(false, $this->validatorManager->validate("  "));
        $this->assertEquals(false, $this->validatorManager->validate("bob bpb"));
        $this->assertEquals(true, $this->validatorManager->validate("bob12"));
    }

}