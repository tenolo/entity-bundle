<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CreationDateTimeInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface CreationDateTimeInterface
{

    /**
     * Set created
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

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
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @return \DateTimeZone|null
     */
    public function getCreatedAtTimeZone();

    /**
     * @param \DateTimeZone $createdAtTimeZone
     */
    public function setCreatedAtTimeZone(\DateTimeZone $createdAtTimeZone);

    /**
     * @return \DateTimeZone|null
     */
    public function getUpdatedAtTimeZone();

    /**
     * @param \DateTimeZone $updatedAtTimeZone
     */
    public function setUpdatedAtTimeZone(\DateTimeZone $updatedAtTimeZone);
} 