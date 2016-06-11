<?php

namespace CabinetBundle\Entity;


use CabinetBundle\Form\Model\RechercheMedicament;
use Doctrine\ORM\EntityRepository;

class MedicamentRepository extends EntityRepository
{
    public function chercher(RechercheMedicament $rechercheMedicament)
    {
        $nom = $rechercheMedicament->getNom();
        $queryBuilder = $this->createQueryBuilder('m');
        if ($nom) {
            $queryBuilder->andWhere('m.nom LIKE :nom')->setParameter('nom', '%' . $nom . '%');
            $queryBuilder->orWhere('m.code LIKE :code')->setParameter('code', '%' . $nom . '%');
        }
        $query = $queryBuilder->orderBy('m.nom', 'ASC')->getQuery();

        return $query->execute();

    }
}