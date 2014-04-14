<?php
namespace Pvessel\TableConverterBundle\Importer;

abstract class AbstractImporter implements ImporterInterface
{
    protected $source;

    public function setSource($string)
    {
        $this->source = $string;
        
        return $this;
    }

    abstract public function getHead();

    abstract public function getBody();
}
