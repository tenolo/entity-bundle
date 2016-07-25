<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Class IDInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface IDInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * @param integer|null $id
     */
    public function setId($id = null);
} 