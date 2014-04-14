<?php
namespace Pvessel\TableConverterBundle\Exporter;

class XmlExporter extends AbstractExporter implements ExporterInterface
{
    public function getTarget()
    {
        $xml = new \SimpleXMLElement('<root/>');
        array_walk_recursive(array_flip($this->head), array ($xml, 'addChild'));
        array_walk_recursive(array_flip($this->body), array ($xml, 'addChild'));
        
        return  $xml->asXML();
    }
}