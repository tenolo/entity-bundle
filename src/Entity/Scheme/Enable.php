<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Enable
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author  Nikita Loges
 * @company tenolo GbR
 * @date    30.07.14
 */
trait Enable
{

    /**
     * @ORM\Column(type="boolean", options={"default"=1})
     */
    protected $enable = true;

    /**
     * @param $enable
     */
    public function setEnabled($enable)
    {
        $this->setEnable($enable);
    }

    /**
     * @param boolean $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * @return boolean
     */
    public function isEnable()
    {
        return $this->enable;
    }

    /**
     * @return boolean
     */
    public function isDisable()
    {
        return !$this->isEnable();
    }

    /**
     * @return boolean
     */
    public function isEnableable()
    {
        return true;
    }

    /**
     * @return boolean
     */
    public function isDisableable()
    {
        return true;
    }
} 