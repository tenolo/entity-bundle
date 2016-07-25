<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class SortOrder
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 30.06.14
 */
trait SortOrder
{

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer")
     */
    protected $sortOrder;

    /**
     * @param int $sortOrder
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param int $increase
     */
    public function increaseSortOrder($increase = null)
    {
        if (empty($increase)) {
            $increase = 1;
        }

        $this->sortOrder += $increase;
    }

    /**
     * @param int $decrease
     */
    public function decreaseSortOrder($decrease = null)
    {
        if (empty($decrease)) {
            $decrease = 1;
        }

        $this->sortOrder -= $decrease;
    }
} 