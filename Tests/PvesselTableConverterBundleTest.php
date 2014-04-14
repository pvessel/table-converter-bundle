<?php
namespace Pvessel\TableConverterBundle\Tests;

use Pvessel\TableConverterBundle\PvesselTableConverterBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PvesselTableConverterBundleTest extends \Phpunit_Framework_TestCase
{
    public function testSubClassOfBundle()
    {
        $rc = new \ReflectionClass('Pvessel\TableConverterBundle\PvesselTableConverterBundle');

        $this->assertTrue($rc->isSubclassOf('Symfony\Component\HttpKernel\Bundle\Bundle'));
    }
    
    public function testAddImporterCompilerPassOnBuild()
    {
        $containerMock = $this->createContainerBuilderMock();
//        $containerMock
//            ->expects($this->at(1))
//            ->method('addImporter')
//            ->with($this->isInstanceOf('Pvessel\TableConverterBundle\DependencyInjection\Compiler\ImporterCompilerPass'))
//        ;
//
        $bundle = new PvesselTableConverterBundle;

        $bundle->build($containerMock);
    }
    
    protected function createContainerBuilderMock()
    {
        return $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder', array(), array(), '', false);
    }
}