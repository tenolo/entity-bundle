<?php

namespace Tenolo\Bundle\EntityBundle\Repository;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Rb\Specification\Doctrine\Exception\LogicException;
use Rb\Specification\Doctrine\Result\ModifierInterface;
use Rb\Specification\Doctrine\SpecificationInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tenolo\Bundle\EntityBundle\Repository\Interfaces\BaseEntityRepositoryInterface;

/**
 * Class BaseEntityRepository
 *
 * @package Tenolo\Bundle\EntityBundle\Repository;
 * @author  Nikita Loges
 * @company tenolo GbR
 * @date    11.06.14
 */
class BaseEntityRepository extends EntityRepository implements BaseEntityRepositoryInterface
{

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureQueryBuilderOptionResolver(OptionsResolver $resolver)
    {
        // set required
        $resolver->setRequired([
            'qb',
        ]);

        // set defaults
        $resolver->setDefaults([
            'qb' => function (Options $options) {
                return $this->getQueryBuilder();
            }
        ]);

        $resolver->setAllowedTypes('qb', QueryBuilder::class);
    }

    /**
     * @deprecated
     */
    public function getDefaultQueryBuilder()
    {
        return $this->getQueryBuilder();
    }

    /**
     * @deprecated
     */
    public function getExpressionBuilder()
    {
        return $this->getQueryBuilder()->expr();
    }

    /**
     * @deprecated
     */
    public function getExpr()
    {
        return $this->getExpressionBuilder();
    }

    /**
     * @inheritdoc
     */
    public function getQueryBuilder()
    {
        return $this->createQueryBuilder('p');
    }

    /**
     * @inheritdoc
     */
    public function getRemoveQueryBuilder()
    {
        $qb = $this->createQueryBuilder('d');
        $qb->delete($this->getEntityName(), 'd');

        return $qb;
    }

    /**
     * @inheritdoc
     */
    public function getUpdateQueryBuilder()
    {
        $qb = $this->createQueryBuilder('u');
        $qb->update($this->getEntityName(), 'u');

        return $qb;
    }

    /**
     * @inheritdoc
     */
    public function getCountQueryBuilder()
    {
        $qb = $this->getQueryBuilder();
        $qb->select("count(p)");

        return $qb;
    }

    /**
     * @inheritdoc
     */
    public function findOneByRandom()
    {
        $qb = $this->getQueryBuilder();

        $qb->setMaxResults(1);
        $qb->setFirstResult(rand(0, $this->findAllCount() - 1));

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @inheritdoc
     */
    public function findOr404(Request $request, array $criteria = [])
    {
        if ($request->get('slug')) {
            $default = ['slug' => $request->get('slug')];
        } elseif ($request->get('id')) {
            $default = ['id' => $request->get('id')];
        } else {
            $default = [];
        }
        $criteria = array_merge($default, $criteria);

        $result = $this->findOneBy($criteria);

        if (!$result) {
            throw new NotFoundHttpException(
                sprintf(
                    'Requested %s does not exist with these criteria: %s.',
                    $this->getClassName(),
                    json_encode($criteria)
                )
            );
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function findOneByOr404(array $criteria)
    {
        $result = $this->findOneBy($criteria);

        if (!$result) {
            throw new NotFoundHttpException(
                sprintf(
                    'Requested %s does not exist with these criteria: %s.',
                    $this->getClassName(),
                    json_encode($criteria)
                )
            );
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function findOneByIdOr404($id)
    {
        $criteria = ['id' => $id];

        return $this->findOneByOr404($criteria);
    }

    /**
     * @inheritdoc
     */
    public function findOneByOrCreate(array $criteria, array $orderBy = null, $flush = true)
    {
        $find = $this->findOneBy($criteria, $orderBy);

        if (!$find) {
            $find = $this->createNew();
            foreach ($criteria as $ci => $value) {
                $methodName = 'set' . ucfirst($ci);
                if (method_exists($find, 'set' . ucfirst($ci))) {
                    call_user_func([$find, $methodName], $value);
                }
            }

            // Nikita Loges: ALWAYS persist, ALWAYS! Do not move to flush statement.
            $this->getEntityManager()->persist($find);

            // only do flush
            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }

        return $find;
    }

    /**
     * @param       $field
     * @param array $values
     *
     * @return mixed
     */
    public function findAllNotIn($field, array $values = [])
    {
        $qb = $this->getQueryBuilder();
        $expr = $qb->expr();

        if (!empty($values)) {
            $qb->andWhere($expr->notIn("p.{$field}", $values));
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @inheritdoc
     */
    public function findAllCount()
    {
        $qb = $this->getCountQueryBuilder();

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @inheritdoc
     */
    public function findCount(Criteria $criteria = null)
    {
        $qb = $this->getQueryBuilder();
        $qb->select("count(p)");

        if ($criteria) {
            $qb->addCriteria($criteria);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @inheritdoc
     */
    public function truncate()
    {
        $cmd = $this->getClassMetadata();
        $connection = $this->getEntityManager()->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $connection->executeUpdate($q);
    }

    /**
     * @inheritdoc
     */
    public function createNew()
    {
        $className = $this->getEntityName();

        return new $className;
    }

    /**
     * @param SpecificationInterface $specification
     * @param ModifierInterface|null $resultModifier
     *
     * @return \Doctrine\ORM\Query|QueryBuilder
     * @throws LogicException
     */
    public function match(SpecificationInterface $specification, ModifierInterface $resultModifier = null)
    {
        $queryBuilder = $this->getSpecificationQueryBuilder($specification);

        if ($resultModifier) {
            $query = $queryBuilder->getQuery();
            $resultModifier->modify($query);

            return $query;
        }

        return $queryBuilder;
    }

    /**
     * @param SpecificationInterface $specification
     *
     * @return QueryBuilder
     * @throws LogicException
     */
    public function getSpecificationQueryBuilder(SpecificationInterface $specification)
    {
        if (!$specification->isSatisfiedBy($this->getEntityName())) {
            throw new LogicException(sprintf(
                'Specification "%s" not supported by this repository!',
                get_class($specification)
            ));
        }

        $queryBuilder = $this->getQueryBuilder();
        $condition = $specification->modify($queryBuilder, $queryBuilder->getRootAliases()[0]);

        if (!empty($condition)) {
            $queryBuilder->where($condition);
        }

        return $queryBuilder;
    }

    /**
     * @inheritdoc
     */
    public function getEntityClassReflection()
    {
        return new \ReflectionClass($this->getEntityName());
    }
} 