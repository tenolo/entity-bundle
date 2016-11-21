<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Class SoftDeleteInterface
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author Nikita Loges
 */
interface SoftDeleteInterface extends DeletableInterface
{

    /**
     * @return \DateTime|null
     */
    public function getDeletedAt();

    /**
     * @param \DateTime|null $deletedAt
     */
    public function setDeletedAt(\DateTime $deletedAt = null);

    /**
     * @return \DateTimeZone|null
     */
    public function getCreatedAtTimeZone();

    /**
     * @param \DateTimeZone|null $createdAtTimeZone
     */
    public function setCreatedAtTimeZone(\DateTimeZone $createdAtTimeZone = null);
}