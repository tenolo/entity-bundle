<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Interface SimpleSortOderInterface
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface SimpleSortOderInterface
{

    /**
     * @param int $sortOrder
     */
    public function setSortOrder($sortOrder);

    /**
     * @return int
     */
    public function getSortOrder();
}
