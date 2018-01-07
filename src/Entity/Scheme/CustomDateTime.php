<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

/**
 * Class CustomDateTime
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author  Nikita Loges
 */
trait CustomDateTime
{

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    protected $useCustomDates = false;

    /**
     * @return bool
     */
    public function isUseCustomDates()
    {
        return $this->useCustomDates;
    }

    /**
     * @param bool $useCustomDates
     */
    public function setUseCustomDates($useCustomDates)
    {
        $this->useCustomDates = $useCustomDates;
    }
}
