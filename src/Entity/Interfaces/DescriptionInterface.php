<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Class DescriptionInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface DescriptionInterface
{

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getDescription();
} 