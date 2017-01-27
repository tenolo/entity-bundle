<?php

namespace Tenolo\Bundle\EntityBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Tenolo\Bundle\EntityBundle\Doctrine\DBAL\Types\DateTimeUTCType;

/**
 * Class TenoloEntityExtension.php
 *
 * @package Tenolo\Bundle\EntityBundle\DependencyInjection
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloEntityExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $doctrine = [
            'dbal' => array(
                'types' => [
                    'datetimeutc' => DateTimeUTCType::class
                ]
            ),
            'orm' => [
                'default_repository_class' => 'Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository',
            ]
        ];

        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'doctrine':
                    $container->prependExtensionConfig($name, $doctrine);
                    break;
            }
        }
    }
}
