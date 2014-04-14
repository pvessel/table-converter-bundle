<?php
namespace Pvessel\TableConverterBundle\Tests\Exporter;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExporterTest extends WebTestCase
{
    public function testThrowExceptionOnUnknownExporter()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

       try {
            $service->setSource('source')
                    ->setImporter('json')
                    ->setExporter('not_existing_exporter');
        } catch (\DomainException $expected) {
            return;
        }

        $this->fail('An expected exception on unknown exporter has not been raised.');
    }
}
