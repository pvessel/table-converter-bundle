<?php
namespace Pvessel\TableConverterBundle\Importer;

class CsvImporter extends AbstractImporter implements ImporterInterface
{
    public function getHead()
    {
        return array();
    }
    
    public function getBody()
    {
        $body = array();
        $rows = str_getcsv($this->source, "\n");

        foreach($rows as $rowIndex => $row) {
            $body[$rowIndex][] = str_getcsv($row, ",");
        }

        return $body;
    }
}