<?php

namespace CabinetBundle\Controller;

use CabinetBundle\Entity\Patient;
use CabinetBundle\Entity\SecuriteSocial;
use CabinetBundle\Form\SecuriteSocialType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecuriteSocialController extends Controller
{
    public function ajoutAction(Request $request, $id)
    {
        $securite = new SecuriteSocial();
        $doctrine = $this->getDoctrine();
        $patient = $doctrine->getRepository('CabinetBundle:Patient')->find($id);
        $form = $this->createForm(new SecuriteSocialType(), $securite);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($securite);
                $patient->ajouterSecuriteSocial($securite);
                $doctrine->getEntityManager()->flush();
                return $this->redirectToRoute('liste_securite_sociale', ['id'=> $patient->getId()]);
            }
        }
        return $this->render('@Cabinet/Securite Sociale/ajout.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient
        ]);
    }

    public function modifierAction(Request $request, $securiteId, $patientId)
    {
        $doctrine = $this->getDoctrine();
        $securite = $doctrine->getRepository('CabinetBundle:SecuriteSocial')->find($securiteId);
        $patient = $doctrine->getRepository('CabinetBundle:Patient')->find($patientId);
        $form = $this->createForm(new SecuriteSocialType(), $securite);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($securite);
                $doctrine->getEntityManager()->flush();
                return $this->redirectToRoute('liste_securite_sociale', ['id' => $patient->getId()]);
            }
        }
        return $this->render('@Cabinet/Securite Sociale/modifier.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient
        ]);
    }
    
    public function listeAction(Request $request, $id)
    {
        $doctrine = $this->getDoctrine();
        $patient = $doctrine->getRepository('CabinetBundle:Patient')->find($id);

        return $this->render('@Cabinet/Securite Sociale/liste.html.twig', [
            'patient' => $patient
        ]);
    }

    public function supprimerAction($id)
    {
        $doctrine = $this->getDoctrine();
        $securite = $doctrine->getRepository('CabinetBundle:SecuriteSocial')->find($id);
        $doctrine->getEntityManager()->remove($securite);
        $doctrine->getEntityManager()->flush();

        return $this->redirectToRoute('liste_securite_sociale', ['id'=> $securite->getId()]);
    }


}