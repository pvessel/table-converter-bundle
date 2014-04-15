<?php
namespace Pvessel\TableConverterBundle\Importer;

class JsonImporter extends AbstractImporter implements ImporterInterface
{
    public function getHead()
    {
        return array_keys($this->getDecoded()[0]);
    }
    
    public function getBody()
    {
        $body = array();
        $rowIndex = 0;
        
        foreach($this->getDecoded() as $row) {
            $body[$rowIndex++] = array_values($row);
        }

        return $body;
    }
    
    protected function getDecoded()
    {
        $decoded = json_decode($this->source, true);

        if(!is_array($decoded)) {
            throw new \Exception('Invalid json');
        }
        
        return $decoded;
    }
}