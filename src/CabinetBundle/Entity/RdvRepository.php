<?php

namespace CabinetBundle\Entity;

use Doctrine\ORM\EntityRepository;

class RdvRepository extends EntityRepository
{

    public function rdvByDate($date, $consultation = false){
        
        $queryBuilder = $this->createQueryBuilder('r')
            ->andWhere('r.date = :date')
            ->setParameter('date', $date);
        if( $consultation){
            $queryBuilder->andWhere('r.consultation is null');
        }
          $query=$queryBuilder->orderBy('r.heure', 'ASC')
            ->getQuery();

        return $query->execute();

    }
    public function chercherRDV(\DateTime $date, \DateTime $heure)
    {

        $heureMin = clone $heure;
        $heureMin = $heureMin->modify("-20 minutes");
        $heureMax = clone $heure;
        $heureMax = $heureMax->modify("+20 minutes");
        $queryBuilder = $this->createQueryBuilder('r')
            ->andWhere('r.date = :date')
            ->setParameter('date', $date)
            ->andWhere('r.heure > :heureMin')
            ->setParameter('heureMin', $heureMin->format('H:i:s'))
            ->andWhere('r.heure < :heureMax')
            ->setParameter('heureMax', $heureMax->format('H:i:s'))
            ->andWhere('r.consultation is null');


        $query = $queryBuilder->getQuery();
        return $query->execute();

    }

}
