# Importers (also called parsers)

Importers are responsible for parsing source string into two arrays:

- head
- body

Therefore they must have at least 3 methods:

- setSource (is called at the beggining of conversion)
- getHead (must return ONE dimension array (or empty one if there are no headers) with column names)
- getBody (must return TWO dimensions array (or empty if there are no content) with column values per row)

See Importer/ImporterInterface for details.

## Built-in importers

There are several built-in importers:

- json
- xml
- html_table
- html_ul
- ascii_table
- csv

You can override this importers by setting up your class parameter.
You can also modify them by extending in your importer.

## Writing your own importers

To create your own importer you must create class with three methods mentioned above: setSource, getHead, getBody:

``` php
use Pvessel\TableConverterBundle\Importer\ImporterInterface;

class ExcelImporter implements ImporterInterface
{
    public function setSource($string)
    {
        // if you must parse source this may be good place to do it
    }

    public function getHead()
    {
        // return ONE dimension array
        return array('column1', 'column2', 'column3');
    }

    public function getBody()
    {
        // return TWO dimensions array
        return array(
            array('col1row1value', 'col2row1value', 'col3row1value'),
            array('col1row2value', 'col2row2value', 'col3row2value'),
        );
    }
}
```

Then let TableConverterBundle know about it by adding "pvessel_array_converter.importer" tag with alias to service file in your bundle.

For example:

``` yaml
    my_own_bundle.table_importer.excel:
        class: Vendor\MyOwnBundle\Importer\ExcelImporter
        tags:
            -  { name: pvessel_table_converter.importer, alias: excel }
```

Use your importer alias when you want to convert table.

For example:

``` php
$convertedTable = $this->container->get('pvessel_table_converter.manager')
                                  ->setSource($contentOfExcel)
                                  ->convert('excel', 'json')
                                  ->getTarget();
```

This should return your table in json format.

[Back to the index](index.md)
