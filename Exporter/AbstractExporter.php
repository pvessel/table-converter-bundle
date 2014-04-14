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
}
