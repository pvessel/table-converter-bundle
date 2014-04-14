<?php

namespace Pvessel\TableConverterBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ImporterCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $tags = $container->findTaggedServiceIds('pvessel_table_converter.importer');

        if (count($tags) > 0 && $container->hasDefinition('pvessel_table_converter.manager')) {
            $manager = $container->getDefinition('pvessel_table_converter.manager');

            foreach ($tags as $id => $tag) {
                $manager->addMethodCall('addImporter', array($tag[0]['alias'], new Reference($id)));
            }
        }
    }
}
