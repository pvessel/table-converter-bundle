<?php
namespace Pvessel\TableConverterBundle\Importer;

interface ImporterInterface
{
    /**
     * Sets source to import
     * 
     * @param string source string
     * @return importer
     */
    public function setSource($string);

    /**
     * Returns one dimension array of head (if applicable)
     * 
     * @return array
     */
    public function getHead();

    /**
     * Returns two dimension array (row/column) of body
     * 
     * @return array
     */
    public function getBody();
}
