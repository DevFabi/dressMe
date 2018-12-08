<?php

namespace DressmeBundle\Repository;

/**
 * PrestationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PrestationRepository extends \Doctrine\ORM\EntityRepository
{
	public function findPrestation()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM DressmeBundle:Prestation p '
            )
            ->getResult();
    }
    public function counter() {
        $qb = $this->createQueryBuilder('p')
        ->select('COUNT(p)');
        return $qb->getQuery()->getSingleScalarResult();
    }

}