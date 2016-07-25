<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Class LockedInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges, tenolo GbR
 */
interface LockedInterface
{

    /**
     * @return boolean
     */
    public function isLocked();

    /**
     * @param boolean $locked
     */
    public function setLocked($locked);

    /**
     *
     */
    public function lock();

    /**
     *
     */
    public function unlock();
}