<?php
namespace Pvessel\TableConverterBundle\Importer;

class HtmlTableImporter extends AbstractImporter implements ImporterInterface
{
    protected $table;
    
    public function setSource($source) 
    {
        $this->table = $this->getTableBySource($source);
        
        return $this;
    }

    public function getHead()
    {
        $head = array();
        
        foreach($this->table->getElementsByTagName('th') as $th) {
            $head[] = $th->nodeValue;
        }
        
        return $head;
    }
    
    public function getBody()
    {
        $body = array();
        $rowIndex = 0;
        
        foreach($this->table->getElementsByTagName('tr') as $row) {
            if($row->getElementsByTagName('td')->item(0)) {
                foreach($row->getElementsByTagName('td') as $cell) {
                    $body[$rowIndex][] = $cell->nodeValue;
                }
                $rowIndex++;
            }
        }

        return $body;
    }
    
    protected function getTableBySource($source)
    {
        $doc = new \DOMDocument();
        $doc->loadHTML($source);  
        
        return $doc->getElementsByTagName('table')->item(0);
    }
}