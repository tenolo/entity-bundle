<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Name
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 27.06.14
 */
trait Name
{

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if(is_null($this->getName())) {
            return '';
        } else {
            return $this->getName();
        }
    }
} 