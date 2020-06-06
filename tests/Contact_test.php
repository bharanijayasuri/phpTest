<?php

use PHPUnit\Framework\TestCase;

class Contact_test extends TestCase
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

}