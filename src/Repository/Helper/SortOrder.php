<?php

namespace Tenolo\Bundle\EntityBundle\Repository\Helper;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;

/**
 * Class SortOrder
 *
 * @package Tenolo\Bundle\EntityBundle\Repository\Helper
 * @author  Nikita Loges
 * @company tenolo GbR
 */
trait SortOrder
{

    public function findSortOrderBetween($start, $end, Criteria $criteria = null)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->getQueryBuilder();

        if ($criteria) {
            $qb->addCriteria($criteria);
        }

        $qb->andWhere($qb->expr()->gt('p.sortOrder', ":start"));
        $qb->andWhere($qb->expr()->lt('p.sortOrder', ":end"));

        $qb->setParameter('start', $start);
        $qb->setParameter('end', $end);

        return $qb->getQuery()->getResult();
    }
} 