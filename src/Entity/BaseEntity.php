<?php

namespace Tenolo\Bundle\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\BaseEntityInterface;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\CreationDateTime;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\DNA;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\ID;

/**
 * Class BaseEntity
 *
 * @package Tenolo\Bundle\EntityBundle\Entity
 * @author  Nikita Loges
 * @company tenolo GbR
 *
 * @ORM\MappedSuperclass
 */
abstract class BaseEntity implements BaseEntityInterface
{

    use ID;
    use CreationDateTime;
    use DNA;

    /**
     *
     */
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());

        if (empty($this->dna)) {
            $this->createDna();
        }
    }
}
