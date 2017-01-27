<?php

namespace Tenolo\Bundle\EntityBundle\Repository\Interfaces;

use Doctrine\ORM\Query;
use Rb\Specification\Doctrine\Exception\LogicException;
use Rb\Specification\Doctrine\Result\ModifierInterface;
use Rb\Specification\Doctrine\SpecificationInterface;

/**
 * Interface SpecificationRepositoryInterface
 *
 * @package Tenolo\Bundle\EntityBundle\Repository\Interfaces
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface SpecificationRepositoryInterface
{

    /**
     * Get the query after matching with given specification.
     *
     * @param SpecificationInterface $specification
     * @param ModifierInterface      $resultModifier
     *
     * @throws LogicException
     *
     * @return Query
     */
    public function match(SpecificationInterface $specification, ModifierInterface $resultModifier = null);
}
