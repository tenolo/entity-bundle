<?php

namespace Tenolo\Bundle\EntityBundle\Repository\Interfaces;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\QueryBuilder;
use Rb\Specification\Doctrine\SpecificationInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class BaseEntityRepositoryInterface
 *
 * @package Tenolo\Bundle\EntityBundle\Repository\Interfaces
 * @author  Nikita Loges, tenolo GbR
 */
interface BaseEntityRepositoryInterface extends ObjectRepository, Selectable, SpecificationRepositoryInterface
{

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder();

    /**
     * @return QueryBuilder
     */
    public function getRemoveQueryBuilder();

    /**
     * @return QueryBuilder
     */
    public function getUpdateQueryBuilder();

    /**
     * @return mixed
     */
    public function findOneByRandom();

    /**
     * @param Request $request
     * @param array   $criteria
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function findOr404(Request $request, array $criteria = []);

    /**
     * @param array $criteria
     *
     * @return null|object
     */
    public function findOneByOr404(array $criteria);

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByIdOr404($id);

    /**
     * @param array $criteria
     * @param array $orderBy
     *
     * @return mixed|null|object
     */
    public function findOneByOrCreate(array $criteria, array $orderBy = null, $flush = true);

    /**
     * @return int
     */
    public function findAllCount();

    /**
     * @param Criteria $criteria
     *
     * @return int
     */
    public function findCount(Criteria $criteria = null);

    /**
     * delete all entries
     */
    public function truncate();

    /**
     * @return mixed
     */
    public function createNew();

    /**
     * @return \ReflectionClass
     */
    public function getEntityClassReflection();

    /**
     * @param SpecificationInterface $specification
     *
     * @return QueryBuilder
     */
    public function getSpecificationQueryBuilder(SpecificationInterface $specification);
}