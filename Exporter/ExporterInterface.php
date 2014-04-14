<?php
namespace Pvessel\TableConverterBundle\Exporter;

interface ExporterInterface
{
    /**
     * Sets head of the source table
     * 
     * @param array head array
     * @return exporter
     */
    public function setHead(array $head);

    /**
     * Sets body of the source table
     * 
     * @param array body array
     * @return exporter
     */
    public function setBody(array $head);

    /**
     * Returns exported string
     * 
     * @return string
     */
    public function getTarget();
}
