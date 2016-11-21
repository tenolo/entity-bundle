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
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    protected $deletedAtTimeZone;

    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        if (!empty($this->deletedAt)) {
            $this->deletedAt->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        }

        return $this->deletedAt;
    }

    /**
     * @param \DateTime|null $deletedAt
     */
    public function setDeletedAt(\DateTime $deletedAt = null)
    {
        if (is_null($deletedAt)) {
            $this->setDeletedAtTimeZone(null);
        } else {
            $this->setDeletedAtTimeZone($deletedAt->getTimezone());
        }
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return \DateTimeZone
     */
    public function getDeletedAtTimeZone()
    {
        if (is_null($this->deletedAtTimeZone)) {
            return null;
        }

        return new \DateTimeZone($this->deletedAtTimeZone);
    }

    /**
     * @param \DateTimeZone $deletedAtTimeZone
     */
    public function setDeletedAtTimeZone(\DateTimeZone $deletedAtTimeZone = null)
    {
        if (!is_null($deletedAtTimeZone)) {
            $this->deletedAtTimeZone = $deletedAtTimeZone->getName();
        } else {
            $this->deletedAtTimeZone = $deletedAtTimeZone;
        }
    }
}