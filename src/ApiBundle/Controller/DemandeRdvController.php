<?php

namespace ApiBundle\Controller;

use CabinetBundle\Entity\DemandeRdv;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DemandeRdvController extends Controller
{

    public function listAction(Request $request)
    {
        $pusername = $request->request->get('txtUsername');
        if ($pusername) {
            $doctrine = $this->getDoctrine();
            $userMobile = $doctrine->getRepository('UserBundle:MobileUser')->findOneBy(['username' => $pusername]);
            if ($userMobile && $userMobile->getPatient()) {
                $rdvs = $doctrine->getRepository('CabinetBundle:DemandeRdv')->findBy([
                    'patient' => $userMobile->getPatient(),
                ]);
                $data = [];
                foreach ($rdvs as $rdv) {
                    $ligne = [];
                    $ligne['id'] = $rdv->getId();
                    $ligne['index'] = $userMobile->getPatient()->getCode();
                    $ligne['nom'] = $userMobile->getPatient()->getNom();
                    $ligne['prenom'] = $userMobile->getPatient()->getPrenom();
                    $ligne['date_naissance'] = $userMobile->getPatient()->getDateNaissance()->format("Y-m-d");
                    $ligne['date_rdv'] = $rdv->getDateRdv()->format('Y-m-d');
                    $ligne['heure_rdv'] = $rdv->getHeureRdv()->format('H:i');
                    $ligne['preferences'] = $rdv->getPreferences();
                    $data[] = $ligne;
                }
                return new JsonResponse($data);
            }
        }
        return new JsonResponse([]);
    }

    public function ajoutAction(Request $request)
    {
        $pusername = $request->request->get('txtUsername');
        $pdate_rdv = $request->request->get('txtdate_rdv');
        $pheure_rdv = $request->request->get('txtheure_rdv');
        $pprefernces = $request->request->get('txtpreferences');

        if ($pusername && $pdate_rdv && $pheure_rdv && $pprefernces) {
            $doctrine = $this->getDoctrine();
            $userMobile = $doctrine->getRepository('UserBundle:MobileUser')->findOneBy(['username' => $pusername]);
            if ($userMobile && $userMobile->getPatient()) {
                $patient = $userMobile->getPatient();
                $demandeRDV = new DemandeRdv();
                $patient->addDemandeRDV($demandeRDV);
                $date = \DateTime::createFromFormat('Y-m-d', $pdate_rdv);
                $demandeRDV->setDateRdv($date);
                $date = \DateTime::createFromFormat('H:i', $pheure_rdv);
                $demandeRDV->setHeureRdv($date);
                $demandeRDV->setPreferences($pprefernces);
                $doctrine->getEntityManager()->persist($demandeRDV);
                $doctrine->getEntityManager()->persist($patient);
                $doctrine->getEntityManager()->flush();
                return new Response("Succé");
            } else {
                return new Response('Votre Compte n\'est pas encore approuvé');
            }
        }
        return new Response("Veuillez verifier vos données");

    }

    public function modifierAction(Request $request)
    {
        $pdate_rdv = $request->request->get('txtdate_rdv');
        $pheure_rdv = $request->request->get('txtheure_rdv');
        $ppreferences = $request->request->get('txtpreferences');

        if ($pdate_rdv && $pheure_rdv && $pheure_rdv && $ppreferences) {
            $pid = $request->request->get('txtid');
            $doctrine = $this->getDoctrine();
            $rdv = $doctrine->getRepository('CabinetBundle:DemandeRdv')->find($pid);
            if ($rdv && !$rdv->isConfirmee()) {
                $date = \DateTime::createFromFormat('Y-m-d', $pdate_rdv);
                $rdv->setDateRdv($date);
                $date = \DateTime::createFromFormat('H:i', $pheure_rdv);
                $rdv->setHeureRdv($date);
                $rdv->setPreferences($ppreferences);
                $doctrine->getEntityManager()->flush();
                return new Response("Succé");
            } else {
                return new Response('Votre demande de RDV est confirmé, vous ne pouvez pas le modifier');
            }
        }
        return new Response("Veuillez verifier vos données");
    }

    public function supprimerAction(Request $request)
    {
        $id = $request->request->get('id');
        $mobile = $request->request->get('mobile');


        if ( $id && $mobile && $mobile == 'android') {

            $doctrine = $this->getDoctrine();
            $rdv = $doctrine->getRepository('CabinetBundle:DemandeRdv')->find($id);
            if ($rdv) {
                $doctrine->getEntityManager()->remove($rdv);
                $doctrine->getEntityManager()->flush();
                return new Response("Succé");
            } 
        }
        return new Response("Veuillez verifier vos données");
    }
}