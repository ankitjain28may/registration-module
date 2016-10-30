<?php
namespace AnkitJain\RegistrationModule\Tests;

use PHPUnit_Framework_TestCase;
use AnkitJain\RegistrationModule;

class ExistsTest
    extends
        PHPUnit_Framework_TestCase
{


    public function ClassNameProvider()
    {
        return [
            [
                RegistrationModule\login::class,
            ],
            [
                RegistrationModule\register::class,
            ],
            [
                RegistrationModule\validate::class,
            ],
        ];
    }

    /**
    * @dataProvider ClassNameProvider
    */
    public function testClassExists($className)
    {
        $this->assertTrue(class_exists($className));
    }
}
