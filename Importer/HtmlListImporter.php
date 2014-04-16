<?php
namespace Pvessel\TableConverterBundle\Importer;

class HtmlListImporter extends AbstractImporter implements ImporterInterface
{
    public function getHead()
    {
        return array();
    }
    
    public function getBody()
    {
        $body = array();
        $rowIndex = 0;

        $doc = new \DOMDocument();
        $doc->loadHTML($this->source);  
        
        $xpath = new \DOMXpath($doc);
        $elements = $xpath->query("*/ul/li");
        foreach($elements as $row) {
                foreach($row->getElementsByTagName('li') as $cell) {
                    $body[$rowIndex][] = $cell->nodeValue;
                }
                $rowIndex++;
        }

        return $body;
    }
   
}