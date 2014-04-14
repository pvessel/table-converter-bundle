<?php

namespace Pvessel\TableConverterBundle\Model;

/**
 * Table
 */
class Table
{
    /**
     * Source before import
     * 
     * @var string
     */
    private $source;

    /**
     * Target after export
     * 
     * @var string
     */
    private $target;

    /**
     * Head of the table after import, before export
     * 
     * @var array
     */
    private $head;

    /**
     * Body of the table after import, before export
     * 
     * @var array
     */
    private $body;


    /**
     * Set source
     *
     * @param string $source
     * @return Table
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set target
     *
     * @param string $target
     * @return Table
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return string 
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set head
     *
     * @param array $head
     * @return Table
     */
    public function setHead(array $head)
    {
        $this->head = $head;

        return $this;
    }

    /**
     * Get head
     *
     * @return array 
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * Set body
     *
     * @param array $body
     * @return Table
     */
    public function setBody(array $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return array 
     */
    public function getBody()
    {
        return $this->body;
    }
}
