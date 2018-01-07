<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CreationDateTime
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author  Nikita Loges
 * @company tenolo GbR
 */
trait CreationDateTime
{

    use CustomDateTime;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetimeutc")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetimeutc")
     */
    protected $updatedAt;

    /**
     * @inheritdoc
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt()
    {

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
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function hasUpdatedAt()
    {
        return !empty($this->updatedAt);
    }
}