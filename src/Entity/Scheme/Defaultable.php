<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Defaultable
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 23.01.2015
 */
trait Defaultable
{

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    protected $isDefault = 0;

    /**
     * @inheritdoc
     */
    public function isDefault()
    {
        return $this->isDefault;
    }

    /**
     * @inheritdoc
     */
    public function setDefault($default)
    {
        $this->isDefault = $default;
    }
}