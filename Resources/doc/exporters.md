# Exporters (also called generators)


Exporters get two php arrays:

- head
- body

and generate target string based on them.

Exporter must have at least 3 methods:

- setHead (will set head of the table)
- setBody (will set body of the table)
- getTarget (should return output string in right format)

See Exporter/ExporterInterface for details.

## Built-in exporters

There are several built-in exporters:

- json
- xml
- html_table
- html_ul
- ascii_table
- csv

You can override this exporters by setting up your class parameter.
You can also modify them by extending in your exporter.

## Writing your own exporters

To create your own exporter you must create class with three methods mentioned above: setHead, setBody, getTarget

For example:

``` php
use Pvessel\TableConverterBundle\Exporter\ExporterInterface;

class ExcelExporter implements ExporterInterface
{
    public function setHead(array $oneDimensionArray)
    {
        // this can be good place to "pregeneration" of table header
    }

    public function setBody(array $twoDimensionArray)
    {
        // this can be good place to "pregeneration" of table content
    }

    public function getTarget()
    {
        // generate your output string here
        return $string
    }
}
```

Then let TableConverterBundle know about it by adding "pvessel_array_converter.exporter" tag with alias to service file in your bundle.

For example:

``` yaml
    my_own_bundle.table_exporter.excel:
        class: Vendor\MyOwnBundle\Importer\ExcelExporter
        tags:
            -  { name: pvessel_table_converter.exporter, alias: excel }
```

Use your importer alias when you want to convert table.

For example:

``` php
$convertedTable = $this->container->get('pvessel_table_converter.manager')
                                  ->setSource($xmlString)
                                  ->convert('xml', 'excel')
                                  ->getTarget();
```

This should return your table in excel format.

[Back to the index](index.md)
