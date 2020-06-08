<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use aadesh\Contact;

class ContactTest extends TestCase
{
    private $test;

    //setup method
    public function setUp(): void
    {
        $this->test = new Contact();
    }

    /*-------------------------------------------------------------*/
    /* Testing empty field inputs and error messages to user*/
    /*-------------------------------------------------------------*/

    public function testNameEmptyFieldOutput()
    {
        //$test = new handle();
        //$_POST['name'] = '';       
        $result = $this->test->returnName('');
        $expected = 'Name is required';
        $this->assertEquals($expected, $result);
    }

    public function testEmailEmptyFieldOutput()
    {
        $result = $this->test->returnEmail('');
        $expected = 'Email is required';
        $this->assertEquals($expected, $result);
    }

    public function testNumberEmptyFieldOutput()
    {
        $result = $this->test->returnNumber('');
        $expected = NULL;
        $this->assertEquals($expected, $result);
    }



    /*---------------------------------------------------------------*/
    /* Testing invalid format field inputs and error messages to user*/
    /*---------------------------------------------------------------*/

    public function testNameInvalidFormatOutput()
    {
        $result = $this->test->returnName('4685434');
        $expected = 'Please use letters only!';
        $this->assertEquals($expected, $result);
    }

   public function testEmailInvalidFormatOutput()
    {
        $result = $this->test->returnEmail('error04.4380');
        $expected = 'Invalid email format';
        $this->assertEquals($expected, $result);
    }

    public function testNumberInvalidFormatOutput()
    {
        $result = $this->test->returnNumber('fdsffds');
        $expected = 'Invalid Number';
        $this->assertEquals($expected, $result);
    }

    
    /*---------------------------------------------------------------*/
    /* Testing correct format field inputs */
    /*---------------------------------------------------------------*/
    public function testNameCorrectInput()
    {
        $result = $this->test->returnName('John');
        $expected = 'Name iss set';
        $this->assertEquals($expected, $result);
    }
}