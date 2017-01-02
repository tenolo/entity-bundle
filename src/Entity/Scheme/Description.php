<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Description
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author  Nikita Loges
 * @company tenolo GbR
 */
trait Description
{

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}