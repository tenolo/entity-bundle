<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Class NameInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface NameInterface
{

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function __toString();
} 