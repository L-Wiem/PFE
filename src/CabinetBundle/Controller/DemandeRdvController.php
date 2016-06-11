<?php

namespace CabinetBundle\Controller;


use CabinetBundle\Entity\Rdv;
use CabinetBundle\Form\RdvType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DemandeRdvController extends Controller
{
    public function listeAction()
    {
        $doctrine = $this->getDoctrine();
        $demandesRdvs = $doctrine->getRepository('CabinetBundle:DemandeRdv')->findBy(
            ['confirmee' => false]
        );
        return $this->render("@Cabinet/DemandeRdv/liste.html.twig", [
            'demandesRdvs' => $demandesRdvs
        ]);
    }

    public function ajoutFromMobileAction(Request $request, $id)
    {

        $rdv = new Rdv();
        $doctrine = $this->getDoctrine();
        $demande = $doctrine->getRepository('CabinetBundle:DemandeRdv')->find($id);
        $rdv->setDate($demande->getDateRdv());
        $rdv->setPatient($demande->getPatient());
        $rdv->setHeure($demande->getHeureRdv());
        $form = $this->createForm(new RdvType(), $rdv);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine->getEntityManager()->persist($rdv);
                $demande->setConfirmee(true);
                $doctrine->getEntityManager()->flush();

                if ($rdv && $rdv->getPatient()->getMobileUser() && $rdv->getPatient()->getMobileUser()->getDeviceId()) {
                    $client = $this->get('endroid.gcm.client');
                    $registrationIds = array(
                        //recuperation from database de each id
                        'registration_ids' => $rdv->getPatient()->getMobileUser()->getDeviceId()
                    );

                    $genre = $rdv->getPatient()->getGenre() == "homme" ? "Mr" : "Mme";
                    $data = array(
                        'title' => 'Cabinet',
                        'message' => $genre . ' ' . $rdv->getPatient()->getNomComplet() . ', votre demande de RDV est confirmé, le : ' . $rdv->getDate()->format('Y-m-d') . ' a ' . $rdv->getHeure()->format('H:i')
                    );
                    $response = $client->send($data, $registrationIds);
                }

                $this->get('session')->getFlashBag()->set('notice_green_panel', "Rendez-vous ajouté avec succès !");
                return $this->redirectToRoute('demande_rdv');

            }
        }
        return $this->render('@Cabinet/Rdv/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function rejeterAction($id)
    {

        $doctrine = $this->getDoctrine();
        $demande = $doctrine->getRepository('CabinetBundle:DemandeRdv')->find($id);
        if ($demande) {
            if ($demande->getPatient()->getMobileUser() && $demande->getPatient()->getMobileUser()->getDeviceId()) {
                $client = $this->get('endroid.gcm.client');
                $registrationIds = array(
                    //recuperation from database de each id
                    'registration_ids' => $demande->getPatient()->getMobileUser()->getDeviceId()
                );

                $genre = $demande->getPatient()->getGenre() == "homme" ? "Mr" : "Mme";
                $data = array(
                    'title' => 'Cabinet',
                    'message' => $genre . ' ' . $demande->getPatient()->getNomComplet() . ', votre demande de RDV a été rejetée'
                );
                $response = $client->send($data, $registrationIds);
            }
            $doctrine->getEntityManager()->remove($demande);
            $doctrine->getEntityManager()->flush();
            $this->get('session')->getFlashBag()->set('notice_green_panel', "Demande de rendez-vous rejetée avec succès !");
        }
        return $this->redirectToRoute('demande_rdv');
    }
}