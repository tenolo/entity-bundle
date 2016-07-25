<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Class SortOrderInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface SortOrderInterface
{

    /**
     * @param int $sortOrder
     */
    public function setSortOrder($sortOrder);

    /**
     * @return int
     */
    public function getSortOrder();

    /**
     * @param int $increase
     */
    public function increaseSortOrder($increase = null);

    /**
     * @param int $decrease
     */
    public function decreaseSortOrder($decrease = null);
} 