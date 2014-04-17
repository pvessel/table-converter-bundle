<?php
namespace Pvessel\TableConverterBundle\Manager;

use Pvessel\TableConverterBundle\Model\Table;
use Pvessel\TableConverterBundle\Importer\ImporterInterface;
use Pvessel\TableConverterBundle\Exporter\ExporterInterface;

class ConverterManager
{
    protected $table;
    protected $importers = array();
    protected $currentImporter;
    protected $exporters = array();
    protected $currentExporter;
    
    public function __construct()
    {
        $this->table = new Table;
    }
    
    public function addImporter($alias, ImporterInterface $importer) 
    {
        $this->importers[$alias] = $importer;

        return $this;
    }

    public function setSource($source)
    {
        $this->table->setSource($source);
        
        return $this;
    }
    
    public function setImporter($importerAlias)
    {
        if(!array_key_exists($importerAlias, $this->importers)) {
            throw new \DomainException('Unknown importer alias: ' . $importerAlias  
                          . '. Valid are: ' . implode(',', array_keys($this->importers)));
        }

        $this->currentImporter = $this->importers[$importerAlias];
        
        return $this;
    }

    public function addExporter($alias, ExporterInterface $exporter) 
    {
        $this->exporters[$alias] = $exporter;

        return $this;
    }

    public function setExporter($exporterAlias)
    {
        if(!array_key_exists($exporterAlias, $this->exporters)) {
            throw new \DomainException('Unknown exporter alias: ' . $exporterAlias 
                          . '. Valid are: ' . implode(',', array_keys($this->exporters)));
        }

        $this->currentExporter = $this->exporters[$exporterAlias];
        
        return $this;
    }

    public function convert($importerAlias, $exporterAlias)
    {
        $this->setImporter($importerAlias);
        $this->setExporter($exporterAlias);

        $this->currentImporter->setSource($this->table->getSource());
        $this->table->setHead($this->currentImporter->getHead());
        $this->table->setBody($this->currentImporter->getBody());
        
        $this->currentExporter->setHead($this->table->getHead());
        $this->currentExporter->setBody($this->table->getBody());
        
        return $this;
    }
    
    public function getTarget()
    {
      return $this->currentExporter->getTarget();
    }
}