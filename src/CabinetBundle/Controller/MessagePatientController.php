<?php

namespace CabinetBundle\Controller;

use CabinetBundle\Entity\Rdv;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessagePatientController extends Controller
{
    public function gcmSendAction($id)
    {
        $doctrine = $this->getDoctrine();
        $rdv = $doctrine->getRepository('CabinetBundle:Rdv')->find($id);
        if ($rdv && $rdv->getPatient()->getMobileUser() && $rdv->getPatient()->getMobileUser()->getDeviceId()) {
            $client = $this->get('endroid.gcm.client');
            $registrationIds = array(
                //recuperation from database de each id
                'registration_ids' => $rdv->getPatient()->getMobileUser()->getDeviceId()
            );

            $genre = $rdv->getPatient()->getGenre() == "homme" ? "Mr" : "Mme";
            $data = array(
                'title' => 'Cabinet',
                'message' => $genre . ' ' . $rdv->getPatient()->getNomComplet() . ', votre RDV sera le : ' . $rdv->getDate()->format('Y-m-d') . ' a ' . $rdv->getHeure()->format('H:i')
            );
            $response = $client->send($data, $registrationIds);
            $this->get('session')->getFlashBag()->set('notice_green_panel', "Notification envoyé au patient");
        } else {
            $this->get('session')->getFlashBag()->set('notice_red_panel', "Patient ne possedant pas une connexion mobile avec CabiNet");
        }
        return $this->redirectToRoute("liste_rdv");
    }

    public function sendSMSAction($id)
    {
        $doctrine = $this->getDoctrine();
        $rdv = $doctrine->getRepository('CabinetBundle:Rdv')->find($id);
        if ($rdv && $rdv->getPatient()->getNumTel()) {
            $genre = $rdv->getPatient()->getGenre() == "homme" ? "Mr" : "Mme";
            $message = $genre . ' ' . $rdv->getPatient()->getNomComplet() . ', votre RDV sera le : ' . $rdv->getDate()->format('Y-m-d') . ' a ' . $rdv->getHeure()->format('H:i');

            $countryCcode = "+216";
            $twilloNumber = "+12564698898";
            $twilloService = $this->get('twilio.api');
            $patientTel = trim($rdv->getPatient()->getNumTel());

            $fullPhoneNumber = $countryCcode . $patientTel;
            $twilloService->account->messages->sendMessage($twilloNumber, $fullPhoneNumber, $message);

            $this->get('session')->getFlashBag()->set('notice_green_panel', "SMS envoyé au patient");
        } else {
            $this->get('session')->getFlashBag()->set('notice_red_panel', "Patient ne possedant pas une numero de telephone valide");
        }
        return $this->redirectToRoute("liste_rdv");
    }
}