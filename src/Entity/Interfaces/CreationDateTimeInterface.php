<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Class CreationDateTimeInterface
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author  Nikita Loges
 */
interface CreationDateTimeInterface
{

    /**
     * Set created
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt = null);

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set created
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt = null);

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @return bool
     */
    public function isUseCustomDates();

    /**
     * @param bool $useCustomDates
     */
    public function setUseCustomDates($useCustomDates);
}