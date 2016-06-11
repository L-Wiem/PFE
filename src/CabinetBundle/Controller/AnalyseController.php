<?php

namespace CabinetBundle\Controller;



use CabinetBundle\Entity\Analyse;
use CabinetBundle\Entity\Consultation;
use CabinetBundle\Form\AnalyseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AnalyseController extends Controller
{
    public function ajoutAction(Request $request, Consultation $consultation){

        $analyse= new Analyse();
        $analyse->setConsultation($consultation);
        $form = $this->createForm(new AnalyseType(), $analyse);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($analyse);
                $doctrine->getEntityManager()->flush();
                return new JsonResponse(['status'=> true]);
            }
        }

        return $this->render('@Cabinet/Analyse/ajout.html.twig', [
            'form' => $form->createView(), 'consultation' => $consultation
        ]);
    }

    public function modifierAction(Request $request, Analyse $analyse)
    {
      //param converter fait la conversion de l'id envoye par le route en objet analyse
        $form = $this->createForm(new AnalyseType(), $analyse);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                //persist n'est pas obligatoire dans le cas de modification d'un objet deja existant
                $doctrine->getEntityManager()->flush();
                return new JsonResponse(['status'=> true]);

            }
        }
        return $this->render('@Cabinet/Analyse/modifier.html.twig', [
            'form' => $form->createView(), 'analyse' => $analyse
        ]);
    }

    public function supprimerAction($id)
    {
            $doctrine = $this->getDoctrine();
            $analyse= $doctrine->getRepository('CabinetBundle:Analyse')->find($id);
            $doctrine->getEntityManager()->remove($analyse);
            $doctrine->getEntityManager()->flush();
            return new JsonResponse(['status'=> true]);

            }
}

