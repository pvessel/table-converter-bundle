<?php
namespace Pvessel\TableConverterBundle\Exporter;

class XmlExporter extends AbstractExporter implements ExporterInterface
{
    public function getTarget()
    {
        $xmlArray = array();
        
        foreach($this->body as $rowIndex => $row) {
            foreach($this->head as $column) {
                $xmlArray[$rowIndex][current($row)] = $column;
                next($row);
            }
        }
        
        $xml = new \SimpleXMLElement('<table/>');
        
        foreach($xmlArray as $xmlArrayRow) {
            $xmlRow = $xml->addChild('row');
            array_walk($xmlArrayRow, array ($xmlRow, 'addChild'));    
        }
        
        return  $xml->asXML();
    }
}