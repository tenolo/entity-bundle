<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Scheme;

use Tenolo\Utilities\Utils\CryptUtil;

/**
 * Class DNA
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Scheme
 * @author  Nikita Loges
 * @company tenolo GbR
 */
trait DNA
{

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $dna;

    /**
     * @inheritdoc
     */
    public function getDna()
    {
        return $this->dna;
    }

    /**
     * @inheritdoc
     */
    public function setDna($dna = null)
    {
        $this->dna = $dna;
    }

    /**
     *
     */
    public function createDna()
    {
        $this->setDna(CryptUtil::getRandomHash(null, 10));
    }
}
