<?php
namespace Pvessel\TableConverterBundle\Exporter;

class HtmlListExporter extends AbstractExporter implements ExporterInterface
{
    public function getTarget()
    {
        $doc = new \DOMDocument();
        $rowUl = $doc->createElement('ul');

        foreach($this->body as $row) {
            $rowLi = $doc->createElement('li');
            $cellUl = $doc->createElement('ul');
            
            foreach($row as $cell) {
                $cellLi = $doc->createElement('li', $cell);
                $cellUl->appendChild($cellLi);
            }

            $rowLi->appendChild($cellUl);
            $rowUl->appendChild($rowLi);
        }

        $doc->appendChild($rowUl);

        return $doc->saveHTML();
    }
}