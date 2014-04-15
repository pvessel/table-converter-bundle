<?php
namespace Pvessel\TableConverterBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TableConvertersionTest extends WebTestCase
{
    public function testJsonToXmlConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource('[{"a":1,"b":2,"c":3,"d":4,"e":5},{"a":11,"b":21,"c":31,"d":41,"e":51}]')
                          ->convert('json', 'xml')
                          ->getTarget();
                          
        $this->assertFalse(false === strpos($target, '<a>1</a><b>2</b><c>3</c><d>4</d><e>5</e>'));        
    }
}
