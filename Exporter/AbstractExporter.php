<?php
namespace Pvessel\TableConverterBundle\Exporter;

abstract class AbstractExporter implements ExporterInterface
{
    protected $head;
    protected $body;

    public function setHead(array $head)
    {
        $this->head = $head;
        
        return $this;
    }

    public function setBody(array $body)
    {
        $this->body = $body;
        
        return $this;
    }

    abstract public function getTarget();
    
    /*
     * This method could be useful if exporter require head, but import provides empty
     */
    protected function getGenerateHeadIfEmpty()
    {
        if(0 == count($this->head)) {
            return array_fill(1, count(reset($this->body)), 'column');
        } else {
            return $this->head;
        }
    }
}
