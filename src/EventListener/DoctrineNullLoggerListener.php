<?php

namespace Tenolo\Bundle\EntityBundle\EventListener;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class DoctrineNullLoggerListener
 *
 * @package Tenolo\Bundle\EntityBundle\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DoctrineNullLoggerListener implements EventSubscriberInterface
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
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest'
        ];
    }

    /**
     * @param GetResponseEvent $event
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
