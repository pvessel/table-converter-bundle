<?php
namespace Pvessel\TableConverterBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ManagerTest extends WebTestCase
{
    public function testCouldBeGetFromContainerAsService()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $this->assertInstanceOf('Pvessel\TableConverterBundle\Manager\ConverterManager', $service);
    }
}
