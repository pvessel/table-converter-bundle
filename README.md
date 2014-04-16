PvesselTableConverterBundle
===========================

This simple bundle provides flexible tool to convert table data between different formats. For example:

Array coded in json may be converted to csv string,
or HTML table can be converted to XML string.

It uses built-in and external "importers" (to parse source string) and "exporters" (to generate target string).


### Installation


#### Step 1: Download PvesselTableConverterBundle using composer

Tell composer to require PvesselTableConverterBundle by running the command:

``` bash
$ php composer.phar require "pvessel/table-converter-bundle:dev-master"
```

Composer will install the bundle to your project's `vendor/pvessel/table-converter-bundle` directory.


#### Step 2: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

        new Pvessel\TableConverterBundle\PvesselTableConverterBundle(),
    );
}
```


### Configuration

This bundle works as service. It means that all you need to get it is:


``` php
$convertedTable = $this->container->get('pvessel_table_converter.manager')
                                  ->setSource($sourceTable)
                                  ->convert($importerAlias, $exporterAlias)
                                  ->getTarget();
```

## Importers and exporters

In order to run, bundle uses importers and exporters.
There are few built-in:

- json
- xml
- html_table
- html_ul
- ascii_table
- csv

See [Documentation](Resources/doc/index.md) for more informations.
