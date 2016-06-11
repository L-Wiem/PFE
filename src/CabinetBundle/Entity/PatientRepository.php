<?php

namespace CabinetBundle\Entity;

use CabinetBundle\Form\Model\RecherchePatient;
use Doctrine\ORM\EntityRepository;

class PatientRepository extends EntityRepository
{
    public function findAll(){

        return $this->findBy(array(), array('dateNaissance' => 'DESC'));
    }
    public function chercher(RecherchePatient $recherchepatient){

        $queryBuilder = $this->createQueryBuilder('p');
        if($recherchepatient->getNom() ){
            $queryBuilder->andWhere('p.nom LIKE :nom')
            ->setParameter('nom','%'. $recherchepatient->getNom().'%');

        }
        if( $recherchepatient->getPrenom()){
            $queryBuilder->andWhere('p.prenom LIKE :prenom')
                ->setParameter('prenom','%'. $recherchepatient->getPrenom().'%');

        }
        if ($recherchepatient->getCode()){
            $queryBuilder->andWhere('p.code LIKE :code')
                ->setParameter('code','%'. $recherchepatient->getCode().'%');
        }
        if ($recherchepatient->getType()){
            $queryBuilder->join('p.securiteSocials', 'securite_social');
            $queryBuilder->andWhere('securite_social.type LIKE :type')
                ->setParameter('type','%'. $recherchepatient->getType().'%');
        }
        $query=$queryBuilder->orderBy('p.nom', 'ASC')
            ->getQuery();

        return $query->execute();

    }
}