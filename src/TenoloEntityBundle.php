<?php

namespace Tenolo\Bundle\EntityBundle;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Mmoreram\SymfonyBundleDependencies\DependentBundleInterface;
use Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;
use Tenolo\Bundle\EntityBundle\DependencyInjection\Compiler\StofDoctrineExtensionCompilerPass;

/**
 * Class TenoloEntityBundle
 *
 * @package Tenolo\Bundle\EmailBundle
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloEntityBundle extends Bundle implements DependentBundleInterface
{

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new StofDoctrineExtensionCompilerPass());
    }

    /**
     * @inheritDoc
     */
    public static function getBundleDependencies(KernelInterface $kernel)
    {
        return [
            FrameworkBundle::class,
            DoctrineBundle::class,
            StofDoctrineExtensionsBundle::class,
        ];
    }
}
