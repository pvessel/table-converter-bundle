<?php
namespace Pvessel\TableConverterBundle\Importer;

class XmlImporter extends AbstractImporter implements ImporterInterface
{
    protected $head = array();
    protected $body = array();
    
    public function setSource($source) 
    {
        $this->setHeadAndBodyBySource($source);
        
        return $this;
    }

    public function getHead()
    {
        return $this->head;
    }
    
    public function getBody()
    {
      return $this->body;
    }
    
    protected function setHeadAndBodyBySource($source)
    {
        $rowIndex = 0;
        
        foreach(simplexml_load_string($source) as $simpleElement) {
            $row = (array) $simpleElement;
            
            $this->body[$rowIndex++] = array_values($row);
            $this->head = array_keys($row);
        }
        
        return $this;
    }
}