<?php

namespace Tenolo\Bundle\EntityBundle;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Mmoreram\SymfonyBundleDependencies\DependentBundleInterface;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;

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
    public static function getBundleDependencies(KernelInterface $kernel)
    {
        return [
            FrameworkBundle::class,
            DoctrineBundle::class,
        ];
    }
}
