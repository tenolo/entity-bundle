<?php

namespace Tenolo\Bundle\EntityBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tenolo\Bundle\EntityBundle\DependencyInjection\Compiler\StofDoctrineExtensionCompilerPass;

/**
 * Class TenoloEntityBundle
 *
 * @package Tenolo\Bundle\EmailBundle
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloEntityBundle extends Bundle
{

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new StofDoctrineExtensionCompilerPass());
    }
}
