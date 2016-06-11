<?php


namespace CabinetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DossierMedicalController extends Controller
{
    public function afficherAction($id){
        
        $doctrine = $this->getDoctrine();
        $patient = $doctrine->getRepository('CabinetBundle:Patient')->find($id);
        return $this->render('@Cabinet/DossierMedical/afficher.html.twig',[
        'patient' => $patient
        ]);
    }

}