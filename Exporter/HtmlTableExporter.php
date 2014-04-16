<?php
namespace Pvessel\TableConverterBundle\Exporter;

class HtmlTableExporter extends AbstractExporter implements ExporterInterface
{
    public function getTarget()
    {
        $doc = new \DOMDocument();
        $table = $doc->createElement('table');

        if(count($this->head) > 0) {
            $table->appendChild($this->getHead($doc)); 
        }

        if(count($this->body) > 0) {
            $table->appendChild($this->getBody($doc)); 
        }

        $doc->appendChild($table);

        return $doc->saveHTML();
    }
    
    private function getHead(&$doc)
    {
        $thead = $doc->createElement('thead');

        $tr = $doc->createElement('tr');

        foreach($this->head as $column) {
            $th = $doc->createElement('th', $column);
            $tr->appendChild($th);
        }

        $thead->appendChild($tr);
        
        return $thead;
    }

    private function getBody(&$doc)
    {
        $tbody = $doc->createElement('tbody');

        foreach($this->body as $row) {
            $tr = $doc->createElement('tr');

            foreach($row as $cell) {
                $td = $doc->createElement('td', $cell);
                $tr->appendChild($td);
            }
            $tbody->appendChild($tr);
        }

        return $tbody;
    }
}