<?php

namespace Tenolo\Bundle\EntityBundle\Entity\Interfaces;

/**
 * Interface DNAInterface
 *
 * @package Tenolo\Bundle\EntityBundle\Entity\Interfaces
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface DNAInterface
{

    /**
     * Get dna
     *
     * @return string
     */
    public function getDna();

    /**
     * @param $dna
     */
    public function setDna($dna = null);

    /**
     * 
     */
    public function createDna();
}
