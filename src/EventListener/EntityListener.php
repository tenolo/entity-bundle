<?php

namespace Tenolo\Bundle\EntityBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\CreationDateTimeInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\DNAInterface;

/**
 * Class EntityListener
 *
 * @package Tenolo\Bundle\EntityBundle\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class EntityListener implements EventSubscriber
{

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate',
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->updateCreatedAt($entity);
        $this->updateUpdatedAt($entity);
        $this->updateDna($entity);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->updateUpdatedAt($entity);
        $this->updateDna($entity);
    }

    /**
     * @param $entity
     */
    protected function updateDna($entity)
    {
        if (!($entity instanceof DNAInterface)) {
            return;
        }

        if (empty($entity->getDna())) {
            $entity->createDna();
        }
    }

    /**
     * @param $entity
     */
    protected function updateCreatedAt($entity)
    {
        if (!($entity instanceof CreationDateTimeInterface)) {
            return;
        }

        if (!empty($entity->getCreatedAt())) {
            return;
        }

        $entity->setCreatedAt(new \DateTime());
    }

    /**
     * @param $entity
     */
    protected function updateUpdatedAt($entity)
    {
        if (!($entity instanceof CreationDateTimeInterface)) {
            return;
        }

        if (empty($entity->getCreatedAt()) || !$entity->isUseCustomDates()) {
            $entity->setUpdatedAt(new \DateTime());
        }
    }

}
