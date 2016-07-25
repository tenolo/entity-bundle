<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseEntityInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface BaseEntityInterface extends IDInterface, CreationDateTimeInterface, DNAInterface
{

    /**
     * @return string
     */
    public function getClassName();

    /**
     * @return string
     */
    public function getClassShortName();

    /**
     * @return string
     */
    public function getClassNamespaceName();
}