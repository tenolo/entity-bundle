<?php

namespace Tenolo\Bundle\EntityBundle;

use Mmoreram\SymfonyBundleDependencies\DependentBundleInterface;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;
use Tenolo\Bundle\CoreBundle\TenoloCoreBundle;

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
     * @inheritdoc
     */
    public static function getBundleDependencies(KernelInterface $kernel)
    {
        return [
            FrameworkBundle::class,
        ];
    }
}
