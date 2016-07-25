<?php

namespace Tenolo\Bundle\EntityBundle\EventListener;

use Gedmo\SoftDeleteable\SoftDeleteableListener as BaseSoftDeleteableListener;
use Doctrine\Common\EventArgs;

/**
 * Class SoftDeleteableListener
 * @package Tenolo\Bundle\EntityBundle\EventListener
 * @author Nikita Loges
 * @company tenolo GbR
 */
class SoftDeleteableListener extends BaseSoftDeleteableListener
{

    /**
     * @inheritdoc
     */
    public function onFlush(EventArgs $args)
    {
        $ea = $this->getEventAdapter($args);
        $om = $ea->getObjectManager();
        //return from event listener if you disabled filter: $em->getFilters()->disable('softdeleteable');
        if (!$om->getFilters()->isEnabled('softdeleteable')) {
            return;
        }

        parent::onFlush($args);
    }

}