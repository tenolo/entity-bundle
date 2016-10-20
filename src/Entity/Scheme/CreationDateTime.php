<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CreationDateTime
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author  Nikita Loges
 * @company tenolo GbR
 * @date    25.06.14
 */
trait CreationDateTime
{

    /**
     * @var \DateTime
     * @ORM\Column(type="datetimeutc")
     */
    protected $createdAt;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $createdAtTimeZone;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetimeutc")
     */
    protected $updatedAt;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $updatedAtTimeZone;

    /**
     * @inheritdoc
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->setCreatedAtTimeZone($createdAt->getTimezone());
        $this->createdAt = $createdAt;
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt()
    {
        if (empty($this->createdAt)) {
            $this->setCreatedAt(new \DateTime());
        } else {
            $this->createdAt->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        }

        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function hasCreatedAt()
    {
        return !empty($this->createdAt);
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->setUpdatedAtTimeZone($updatedAt->getTimezone());
        $this->updatedAt = $updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        if (empty($this->updatedAt)) {
            $this->setUpdatedAt(new \DateTime());
        } else {
            $this->updatedAt->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        }

        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function hasUpdatedAt()
    {
        return !empty($this->updatedAt);
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAtTimeZone()
    {
        if (is_null($this->createdAtTimeZone)) {
            return null;
        }

        return new \DateTimeZone($this->createdAtTimeZone);
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAtTimeZone(\DateTimeZone $createdAtTimeZone)
    {
        $this->createdAtTimeZone = $createdAtTimeZone->getName();
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAtTimeZone()
    {
        if (is_null($this->updatedAtTimeZone)) {
            return null;
        }

        return new \DateTimeZone($this->updatedAtTimeZone);
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAtTimeZone(\DateTimeZone $updatedAtTimeZone)
    {
        $this->updatedAtTimeZone = $updatedAtTimeZone->getName();
    }
} 