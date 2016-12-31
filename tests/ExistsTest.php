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
                RegistrationModule\Login::class,
            ],
            [
                RegistrationModule\Register::class,
            ],
            [
                RegistrationModule\Validate::class,
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
