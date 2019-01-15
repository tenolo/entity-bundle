<?php

namespace Tenolo\Bundle\EntityBundle\Services;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Tenolo\Bundle\EntityBundle\Annotation\DnaAuthorization;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\DNAInterface;

/**
 * Class EntityDnaVerifier
 *
 * @package Tenolo\Bundle\EntityBundle\Services
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class EntityDnaVerifier
{

    /** @var RequestStack */
    protected $requestStack;

    /** @var RegistryInterface */
    protected $registry;

    /**
     * @param RequestStack      $requestStack
     * @param RegistryInterface $registry
     */
    public function __construct(RequestStack $requestStack, RegistryInterface $registry)
    {
        $this->requestStack = $requestStack;
        $this->registry = $registry;
    }

    /**
     * @param                  $className
     * @param DnaAuthorization $methodAnnotation
     *
     * @return bool
     */
    public function verifyByAnnotation($className, DnaAuthorization $methodAnnotation)
    {
        if (empty($className)) {
            return false;
        }

        $paramValue = $this->getRequest()->get($methodAnnotation->paramName);

        if ($methodAnnotation->nullable && $paramValue === null) {
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
        if (empty($className)) {
            return false;
        }

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
        if (empty($className)) {
            return false;
        }

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
        return $entity->getDna() === $dna;
    }

    /**
     * @param $className
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function findRepository($className)
    {
        return $this->registry->getRepository($className);
    }

    /**
     * @return null|\Symfony\Component\HttpFoundation\Request
     */
    protected function getRequest()
    {
        return $this->requestStack->getMasterRequest();
    }
}
