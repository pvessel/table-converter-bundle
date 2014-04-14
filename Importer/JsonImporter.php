<?php
namespace Pvessel\TableConverterBundle\Importer;

class JsonImporter extends AbstractImporter implements ImporterInterface
{
    public function getHead()
    {
        return array();
    }
    
    public function getBody()
    {
        $decoded = json_decode($this->source, true);

        if(!is_array($decoded)) {
            throw new \Exception('Invalid json');
        }
        
        return $decoded;
    }
}