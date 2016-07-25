<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Class DeletableInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface DeletableInterface
{

    /**
     * @return bool
     */
    public function isDeletable();

    /**
     * @param bool $delteable
     */
    public function setDeletable($delteable);
}