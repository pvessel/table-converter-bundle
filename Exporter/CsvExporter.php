<?php
namespace Pvessel\TableConverterBundle\Exporter;

class CsvExporter extends AbstractExporter implements ExporterInterface
{
    public function getTarget()
    {
        $target = '';

        foreach ($this->body as $row) {
            $target .= (implode(',', $row)) . "\n";
        }
        
        return $target;
    }
}