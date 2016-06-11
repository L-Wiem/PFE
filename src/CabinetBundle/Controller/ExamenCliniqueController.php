<?php

namespace CabinetBundle\Controller;


use CabinetBundle\Entity\Consultation;
use CabinetBundle\Entity\ExamenClinique;
use CabinetBundle\Entity\Traitement;
use CabinetBundle\Form\ExamenCliniqueType;
use CabinetBundle\Form\TraitementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ExamenCliniqueController extends Controller
{
    public function ajoutAction(Request $request, Consultation $consultation){

        $examenClinique= new ExamenClinique();
        $examenClinique->setConsultation($consultation);
        $form = $this->createForm(new ExamenCliniqueType(), $examenClinique);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($examenClinique);
                $doctrine->getEntityManager()->flush();
                return new JsonResponse(['status'=> true]);


            }
        }

        return $this->render('@Cabinet/ExamenClinique/ajout.html.twig', [
            'form' => $form->createView(), 'consultation' => $consultation
        ]);

    }

    public function modifierAction(Request $request, ExamenClinique $examenClinique)
    {
        //param converter fait la conversion de l'id envoye par le route en objet analyse
        $form = $this->createForm(new ExamenCliniqueType(), $examenClinique);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                //persist n'est pas obligatoire dans le cas de modification d'un objet deja existant
                $doctrine->getEntityManager()->flush();
                return new JsonResponse(['status'=> true]);

            }
        }
        return $this->render('@Cabinet/ExamenClinique/modifier.html.twig', [
            'form' => $form->createView(), 'examenClinique' => $examenClinique
        ]);
    }

    public function supprimerAction($id)
    {
        $doctrine = $this->getDoctrine();
        $examenClinique= $doctrine->getRepository('CabinetBundle:ExamenClinique')->find($id);
        $doctrine->getEntityManager()->remove($examenClinique);
        $doctrine->getEntityManager()->flush();
        return new JsonResponse(['status'=> true]);

    }

}