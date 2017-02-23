<?php

namespace Tenolo\Bundle\EntityBundle\Services;

use Tenolo\Bundle\CoreBundle\Service\AbstractService;
use Tenolo\Bundle\EntityBundle\Annotation\DnaAuthorization;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\DNAInterface;

/**
 * Class EntityDnaVerifier
 *
 * @package Tenolo\Bundle\EntityBundle\Services
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class EntityDnaVerifier extends AbstractService
{

    /**
     * @param                  $className
     * @param DnaAuthorization $methodAnnotation
     *
     * @return bool
     */
    public function verifyByAnnotation($className, DnaAuthorization $methodAnnotation)
    {
        $paramValue = $this->getRequest()->get($methodAnnotation->paramName);

        if ($methodAnnotation->nullable && is_null($paramValue)) {
            return true;
        }

        return $this->verifyByRequest($className, $methodAnnotation->paramName, $methodAnnotation->dna);
    }

    /**
     * @param $className
     * @param $paramName
     * @param $dnaParamName
     *
     * @return bool
     */
    public function verifyByRequest($className, $paramName, $dnaParamName)
    {
        $paramValue = $this->getRequest()->get($paramName);
        $dnaValue = $this->getRequest()->get($dnaParamName);

        return $this->verifyById($className, $paramValue, $dnaValue);
    }

    /**
     * @param $className
     * @param $entityId
     * @param $dna
     *
     * @return bool
     */
    public function verifyById($className, $entityId, $dna)
    {
        /** @var DNAInterface $entity */
        $entity = $this->findRepository($className)->find($entityId);

        $ref = new \ReflectionClass($entity);

        if (!$ref->implementsInterface(DNAInterface::class)) {
            throw new \RuntimeException('entity is not from type ' . DNAInterface::class);
        }

        return $this->verify($entity, $dna);
    }

    /**
     * @param DNAInterface $entity
     * @param              $dna
     *
     * @return bool
     */
    public function verify(DNAInterface $entity, $dna)
    {
        if ($entity->getDna() != $dna) {
            return false;
        }

        return true;
    }
}
