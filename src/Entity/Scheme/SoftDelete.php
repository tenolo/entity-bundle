<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

/**
 * Class SoftDelete
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author  Nikita Loges
 * @company tenolo GbR
 * @date    21.01.2015
 */
trait SoftDelete
{
    use Deletable;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $deletedAtTimeZone;

    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime|null $deletedAt
     */
    public function setDeletedAt(\DateTime $deletedAt = null)
    {
        if (is_null($deletedAt)) {
            $this->setCreatedAtTimeZone(null);
        } else {
            $this->setCreatedAtTimeZone($deletedAt->getTimezone());
        }
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return \DateTimeZone
     */
    public function getCreatedAtTimeZone()
    {
        if (is_null($this->createdAtTimeZone)) {
            return null;
        }

        return new \DateTimeZone($this->createdAtTimeZone);
    }

    /**
     * @param \DateTimeZone $createdAtTimeZone
     */
    public function setCreatedAtTimeZone(\DateTimeZone $createdAtTimeZone = null)
    {
        if (!is_null($createdAtTimeZone)) {
            $this->createdAtTimeZone = $createdAtTimeZone->getName();
        } else {
            $this->createdAtTimeZone = $createdAtTimeZone;
        }
    }
}