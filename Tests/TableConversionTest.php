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

    public function testHtmlTablelToJsonConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource('<html><p>This is paragraph.</p><table><thead><tr><th>column1</th><th>column2</th><th>column3</th></tr></thead><tbody><tr><td>a</td><td>b</td><td>c</td></tr><tr><td>d</td><td>e</td><td>f</td></tr></tbody></table></html>')
                          ->convert('html_table', 'json')
                          ->getTarget();

        $this->assertTrue($target == '[{"column1":"a","column2":"b","column3":"c"},{"column1":"d","column2":"e","column3":"f"}]');
    }

    public function testHtmlListlToXmlConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource('<html><ul><li><ul><li>a</li><li>b</li><li>c</li></ul></li><li><ul><li>d</li><li>e</li><li>f</li></ul></li></ul></html>')
                          ->convert('html_ul', 'xml')
                          ->getTarget();

        $this->assertTrue(false !== strpos($target, '<table><row><column>a</column><column>b</column><column>c</column></row><row><column>d</column><column>e</column><column>f</column></row></table>'));
    }

    public function testJsonToHtmlTableConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource('[{"a":1,"b":2,"c":3,"d":4,"e":5},{"a":11,"b":21,"c":31,"d":41,"e":51}]')
                          ->convert('json', 'html_table')
                          ->getTarget();

        $this->assertTrue(false !== strpos($target, '<table><thead><tr><th>a</th><th>b</th><th>c</th><th>d</th><th>e</th></tr></thead><tbody><tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr><tr><td>11</td><td>21</td><td>31</td><td>41</td><td>51</td></tr></tbody></table>'));
    }

    public function testXmlToHtmlListConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource('<?xml version="1.0"?><table><row><column1>a</column1><column2>b</column2><column3>c</column3></row><row><column1>d</column1><column2>e</column2><column3>f</column3></row></table>')
                          ->convert('xml', 'html_ul')
                          ->getTarget();

        $this->assertTrue(false !== strpos($target, '<ul><li><ul><li>a</li><li>b</li><li>c</li></ul></li><li><ul><li>d</li><li>e</li><li>f</li></ul></li></ul>'));
    }
    
    public function testCsvToJsonConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource("1,2,3,4,5\n11,21,31,41,51")
                          ->convert('csv', 'json')
                          ->getTarget();

        $this->assertTrue($target ==  '[{"column":["1","2","3","4","5"]},{"column":["11","21","31","41","51"]}]');
    }

    public function testHtmlListToCsvConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource("<ul><li><ul><li>a</li><li>b</li><li>c</li></ul></li><li><ul><li>d</li><li>e</li><li>f</li></ul></li></ul>")
                          ->convert('html_ul', 'csv')
                          ->getTarget();

        $this->assertTrue(false !== strpos($target, "a,b,c\nd,e,f"));
    }

    public function testAsciiTableToCsvConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource(<<<EOF
======
|a|b|c|
|d|e|f|
-------
EOF
                          )
                          ->convert('ascii_table', 'csv')
                          ->getTarget();

        $this->assertTrue(false !== strpos($target, "a,b,c\nd,e,f"));
    }

    public function testHtmlTablelToAsciiTableConversion()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

        $target = $service->setSource('<html><p>This is paragraph.</p><table><thead><tr><th>column1</th><th>column2</th><th>column3</th></tr></thead><tbody><tr><td>a</td><td>b</td><td>c</td></tr><tr><td>d</td><td>e</td><td>f</td></tr></tbody></table></html>')
                          ->convert('html_table', 'ascii_table')
                          ->getTarget();

        $this->assertTrue(false !== strpos($target, "|column1|column2|column3|"));
        
        $this->assertTrue(false !== strpos($target, "|a      |b      |c      |\n|d      |e      |f"));
    }
    
}
