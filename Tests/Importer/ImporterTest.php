<?php
namespace Pvessel\TableConverterBundle\Tests\Importer;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImporterTest extends WebTestCase
{
    public function testThrowExceptionOnUnknownImporter()
    {
        $this->createClient();
        $service = self::$kernel->getContainer()->get('pvessel_table_converter.manager');

       try {
            $service->setSource('source')->setImporter('not_existing_importer');
        } catch (\DomainException $expected) {
            return;
        }

        $this->fail('An expected exception on unknown importer has not been raised.');
    }
}
