<?php
namespace Pvessel\TableConverterBundle\Exporter;

class AsciiTableExporter extends AbstractExporter implements ExporterInterface
{
    public function getTarget()
    {
        $target = '';
        $longestCellLength = $this->getLongestCellLength();

        if(count($this->head) > 0) {
            $target .= $this->getHead($longestCellLength); 
        }

        if(count($this->body) > 0) {
            $target .= $this->getBody($longestCellLength); 
        }

        return $target;
    }
    
    protected function getLongestCellLength()
    {
        $headLengths = array_map('strlen', $this->head);
        $max = max($headLengths);
        
        foreach ($this->body as $row) {
            $rowLengths = array_merge(array_map('strlen', $row), array($max));
            
            $max = max($rowLengths);
        }
        
        return $max;
    }
    
    protected function getHead($longestCellLength)
    {
        return $this->getLine($this->head, $longestCellLength)
              . "\n"
              . $this->getRow($this->head, $longestCellLength)
              . $this->getLine($this->head, $longestCellLength)
              . "\n";
    }
    
    protected function getBody($longestCellLength)
    {
        $body = $this->getLine(reset($this->body), $longestCellLength) . "\n";
        
        foreach($this->body as $row) {
            $body .= $this->getRow($row, $longestCellLength);
        }
        
        $body .= $this->getLine(reset($this->body), $longestCellLength) . "\n";
        
        return $body;
    }
    
    protected function getRow(array $row, $longestCellLength)
    {
        return  '|' 
                . implode(
                    '|', 
                    array_map(function($val) use ($longestCellLength) { return str_pad($val, $longestCellLength, ' '); }, $row)
                )
                . "|\n";
    }
    
    protected function getLine(array $row, $longestCellLength)
    {
        return str_repeat("=", ($longestCellLength + 1) * count($row) + 1);        
    }
}