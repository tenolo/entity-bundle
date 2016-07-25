<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Locked
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author Nikita Loges, tenolo GbR
 */
trait Locked
{

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    protected $locked = 0;

    /**
     * @return boolean
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * @param boolean $locked
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

    /**
     *
     */
    public function lock()
    {
        $this->locked = true;
    }

    /**
     *
     */
    public function unlock()
    {
        $this->locked = false;
    }
}