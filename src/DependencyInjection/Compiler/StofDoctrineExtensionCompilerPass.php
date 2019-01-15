<?php

namespace Tenolo\Bundle\EntityBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tenolo\Bundle\EntityBundle\EventListener\SoftDeleteableListener;

/**
 * Class StofDoctrineExtensionCompilerPass
 *
 * @package Tenolo\Bundle\EntityBundle\DependencyInjection\Compiler
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class StofDoctrineExtensionCompilerPass implements CompilerPassInterface
{

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if(!$container->hasDefinition('stof_doctrine_extensions.listener.softdeleteable')) {
            return;
        }

        $definition = $container->findDefinition('stof_doctrine_extensions.listener.softdeleteable');
        $definition->setClass(SoftDeleteableListener::class);
    }

}
