<?php
namespace Pvessel\TableConverterBundle\Exporter;

class JsonExporter extends AbstractExporter implements ExporterInterface
{
    public function getTarget()
    {
        $head = $this->getGenerateHeadIfEmpty();

        $jsonArray = array();
        
        foreach($this->body as $rowIndex => $row) {
            foreach($head as $column) {
                $jsonArray[$rowIndex][$column] = current($row);
                next($row);
            }
        }

        return json_encode($jsonArray);
    }
}