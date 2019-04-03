<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Interface EnableInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface EnableInterface
{

    /**
     * @param boolean $enable
     */
    public function setEnabled($enable);

    /**
     * @param boolean $enable
     */
    public function setEnable($enable);

    /**
     * @return bool
     */
    public function isEnable();

    /**
     * @return boolean
     */
    public function isEnableable();

    /**
     * @return boolean
     */
    public function isDisableable();
} 