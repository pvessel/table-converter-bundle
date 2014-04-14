<?php

namespace Pvessel\TableConverterBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ExporterCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $tags = $container->findTaggedServiceIds('pvessel_table_converter.exporter');

        if (count($tags) > 0 && $container->hasDefinition('pvessel_table_converter.manager')) {
            $manager = $container->getDefinition('pvessel_table_converter.manager');

            foreach ($tags as $id => $tag) {
                $manager->addMethodCall('addExporter', array($tag[0]['alias'], new Reference($id)));
            }
        }
    }
}
