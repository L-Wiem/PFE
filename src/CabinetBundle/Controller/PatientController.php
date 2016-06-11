<?php

namespace CabinetBundle\Controller;

use CabinetBundle\Entity\Patient;
use CabinetBundle\Form\Model\RecherchePatient;
use CabinetBundle\Form\PatientRechercheType;
use CabinetBundle\Form\PatientType;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\MobileUser;

class PatientController extends Controller
{
    public function ajoutAction(Request $request)
    {
        $patient = new Patient();
        $form = $this->createForm(new PatientType(), $patient);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($patient);
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "Patient ajouté avec succès !");
                return $this->redirectToRoute('liste_patient');
            }
        }
        return $this->render('@Cabinet/Patient/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function ajoutFromUserAction(MobileUser $mobileUser)
    {

        $patient = new Patient();
        $patient->setMobileUser($mobileUser);
        $mobileUser->setPatient($patient);
        $patient->setCode(" ");
        $patient->setEtatCivil("Célibataire");
        $patient->setNom($mobileUser->getNom());
        $patient->setPrenom($mobileUser->getPrenom());
        $patient->setGenre($mobileUser->getGenre());
        $doctrine = $this->getDoctrine();
        $doctrine->getEntityManager()->persist($patient);
        $doctrine->getEntityManager()->persist($mobileUser);
        $doctrine->getEntityManager()->flush();
        $this->get('session')->getFlashBag()->set('notice_green_panel', "Patient ajouté avec succès !");
        return $this->redirectToRoute('modifier_patient', [

            'id' => $patient->getId()

        ]);
    }


    public function modifierAction(Request $request, $id)
    {
        $doctrine = $this->getDoctrine();
        $patient = $doctrine->getRepository('CabinetBundle:Patient')->find($id);
        $form = $this->createForm(new PatientType(), $patient);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($patient);
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "Patient modifié avec succès !");

                return $this->redirectToRoute('liste_patient');

            }
        }
        return $this->render('@Cabinet/Patient/modifier.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function listeAction(Request $request)
    {
        $recherchePatient = new RecherchePatient();
        $form = $this->createForm(new PatientRechercheType(), $recherchePatient);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);

        }
        $doctrine = $this->getDoctrine();
        $patients = $doctrine->getRepository('CabinetBundle:Patient')->chercher($recherchePatient);
        return $this->render('@Cabinet/Patient/liste.html.twig', [
            'patients' => $patients,
            'form' => $form->createView()
        ]);

    }


    public function ficheAction(Request $request, $id)
    {
        $doctrine = $this->getDoctrine();
        $patient = $doctrine->getRepository('CabinetBundle:Patient')->find($id);

        return $this->render('@Cabinet/Patient/fiche.html.twig', [
            'patient' => $patient
        ]);
    }

//    public function supprimerAction($id)
//    {
//        try {
//            $doctrine = $this->getDoctrine();
//            $patient = $doctrine->getRepository('CabinetBundle:Patient')->find($id);
//            $doctrine->getEntityManager()->remove($patient);
//            $doctrine->getEntityManager()->flush();
//            $this->get('session')->getFlashBag()->set('notice_green_panel', "Patient supprimé avec succès !");
//        } catch (ForeignKeyConstraintViolationException $e) {
//            $this->get('session')->getFlashBag()->set('notice_red_panel', "Ce Patient ne peut pas être supprimé");
//        }
//        return $this->redirectToRoute('liste_patient');
//    }
}
