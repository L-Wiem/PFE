<?php

namespace CabinetBundle\Controller;

use CabinetBundle\Entity\Patient;
use CabinetBundle\Entity\Rdv;
use CabinetBundle\Form\RdvType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RendezVousController extends Controller
{
    public function listeAction()
    {
        $doctrine = $this->getDoctrine();
        $dateAjourdhui = new \DateTime("now");
        $rdvs = $doctrine->getRepository('CabinetBundle:Rdv')->rdvByDate($dateAjourdhui->format("Y-m-d"), true);

        return $this->render('@Cabinet/Rdv/liste.html.twig', [
            'rdvs' => $rdvs,
            'date' => $dateAjourdhui
        ]);
    }

    public function afficherAction($date)
    {
        $dateAjourdhui = new \DateTime("now");

        $doctrine = $this->getDoctrine();
        $rdvs = $doctrine->getRepository('CabinetBundle:Rdv')->rdvByDate($date, true);

        return $this->render('@Cabinet/Rdv/liste.html.twig', [
            'rdvs' => $rdvs,
            'date' => $date

        ]);


    }

    public function ajoutAction(Request $request, $date)
    {
        $rdv = new Rdv();
        $date = new \DateTime($date);
        $rdv->setDate($date);
        $form = $this->createForm(new RdvType(), $rdv);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($rdv);
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "RDV créé avec succès !");
                return $this->redirectToRoute('liste_rdv');

            }
        }
        return $this->render('@Cabinet/Rdv/ajout.html.twig', [
            'form' => $form->createView(),
            'rdv' => $rdv
        ]);
    }

    public function modifierAction(Request $request, Rdv $rdv)
    {
        $form = $this->createForm(new RdvType(), $rdv);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($rdv);
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "RDV modifié avec succès !");
                return $this->redirectToRoute('liste_rdv');

            }
        }
        return $this->render('@Cabinet/Rdv/modifier.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function annulerAction($id)
    {
        $doctrine = $this->getDoctrine();
        $rdv = $doctrine->getRepository('CabinetBundle:Rdv')->find($id);
        $doctrine->getEntityManager()->remove($rdv);
        $this->get('session')->getFlashBag()->set('notice_green_panel', "RDV supprimé avec succès !");
        $doctrine->getEntityManager()->flush();

        return $this->redirectToRoute('liste_rdv');
    }


}
