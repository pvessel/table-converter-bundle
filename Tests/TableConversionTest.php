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
    
    public function testXmlToJsonConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource('<?xml version="1.0"?><table><row><column1>a</column1><column2>b</column2><column3>c</column3></row><row><column1>d</column1><column2>e</column2><column3>f</column3></row></table>')
                          ->convert('xml', 'json')
                          ->getTarget();
                          
        $this->assertTrue($target == '[{"column1":"a","column2":"b","column3":"c"},{"column1":"d","column2":"e","column3":"f"}]');
                        
    }
    
}
