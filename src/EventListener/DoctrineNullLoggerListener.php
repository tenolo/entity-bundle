<?php

namespace Tenolo\Bundle\EntityBundle\EventListener;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class DoctrineNullLoggerListener
 *
 * @package Tenolo\Bundle\EntityBundle\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DoctrineNullLoggerListener
{

    /** @var ManagerRegistry */
    protected $registry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     *
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        /** @var Connection $connection */
        $connection = $this->registry->getConnection();

        $configuration = $connection->getConfiguration();
        $configuration->setSQLLogger(null);
    }
}
