<?php

namespace Tenolo\Bundle\EntityBundle\DependencyInjection;

use Sonata\Doctrine\Types\JsonType;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Tenolo\Bundle\EntityBundle\Doctrine\DBAL\Types\DateTimeUTCType;
use Tenolo\Bundle\EntityBundle\Doctrine\DBAL\Types\TimeUTCType;
use Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository;

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
            'dbal' => [
                'types' => [
                    'json'        => JsonType::class,
                    'datetime'    => DateTimeUTCType::class,
                    'datetimeutc' => DateTimeUTCType::class,
                    'timeutc'     => TimeUTCType::class
                ]
            ],
            'orm'  => [
                'default_repository_class' => BaseEntityRepository::class,
            ]
        ];

        $container->prependExtensionConfig('doctrine', $doctrine);
    }
}
