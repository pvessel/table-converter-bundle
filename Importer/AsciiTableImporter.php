<?php
namespace Pvessel\TableConverterBundle\Importer;

class AsciiTableImporter extends AbstractImporter implements ImporterInterface
{
    public function getHead()
    {
        return array();
    }
    
    public function getBody()
    {
        $body = array();
        
        $rows = explode("\n", $this->source);

        foreach($rows as $rowIndex => $row) {
            if(preg_match('/^\|([0-9A-Za-z\|]+)\|$/', $row, $matches)) {
                $body[$rowIndex] = explode('|', $matches[1]);
            }
        }

        return $body;
    }
}