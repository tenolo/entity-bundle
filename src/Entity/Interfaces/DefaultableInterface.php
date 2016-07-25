<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Class DefaultableInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface DefaultableInterface
{

    /**
     * @return bool
     */
    public function isDefault();

    /**
     * @param bool $default
     */
    public function setDefault($default);
}