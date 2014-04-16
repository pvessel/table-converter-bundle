# Installation

#### Step 1: Download PvesselTableConverterBundle using composer

Tell composer to require PvesselTableConverterBundle by running the command:

``` bash
$ php composer.phar require "pvessel/table-converter-bundle:dev-master"
```

Composer will install the bundle to your project's `vendor/pvessel/table-converter-bundle` directory.

You may also add "pvessel/table-converter-bundle:dev-master" to your composer.json file.

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

Congratulations! Now you are ready to convert!

[Back to the index](index.md)
