<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Deletable
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 22.01.2015
 */
trait Deletable
{

    /**
     * @ORM\Column(type="boolean", options={"default": 1})
     */
    protected $deletable = true;

    /**
     * @return bool
     */
    public function isDeletable()
    {
        return $this->deletable;
    }

    /**
     * @param bool $deleteable
     */
    public function setDeletable($deleteable)
    {
        $this->deletable = $deleteable;
    }
}