<?php
namespace AppBundle\Repository;
/**
 * ScheduleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ScheduleRepository extends \Doctrine\ORM\EntityRepository
{
	 public function dropEvent($idEvent, $startDate, $endDate)
    {
        return $this
            ->createQueryBuilder('e')
            ->update('AppBundle:Schedule', 'e')
            ->set('e.start', '?1')
            ->set('e.end', '?2')
            ->where('e.id = ?3')
            ->setParameter(1, $startDate)
            ->setParameter(2, $endDate)
            ->setParameter(3, $idEvent)
            ->getQuery()
            ->getResult();
    }
    public function editEvent($idEvent, $title)
    {
        return $this
            ->createQueryBuilder('e')
            ->update('AppBundle:Schedule', 'e')
            ->set('e.commentaire', '?1')
            ->where('e.id = ?2')
            ->setParameter(1, $newComm)
            ->setParameter(2, $idEvent)
            ->getQuery()
            ->getResult();
    }
 
    public function deleteEvent($idEvent)
    {
        return $this
            ->createQueryBuilder('e')
            ->delete('AppBundle:Schedule', 'e')
            ->where('e.id = ?1')
            ->setParameter(1, $idEvent)
            ->getQuery()
            ->getResult();
    }
}