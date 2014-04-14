<?php

namespace Pvessel\TableConverterBundle;

use Pvessel\TableConverterBundle\DependencyInjection\Compiler\ImporterCompilerPass;
use Pvessel\TableConverterBundle\DependencyInjection\Compiler\ExporterCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;    
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PvesselTableConverterBundle extends Bundle
{
   /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ImporterCompilerPass);
        $container->addCompilerPass(new ExporterCompilerPass);
    }    
}
