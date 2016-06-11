<?php

namespace CabinetBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MedecinController extends Controller
{
    public function profileAction(Request $request){
        $doctrine = $this->getDoctrine();
        $medecin = $doctrine->getRepository('CabinetBundle:Medecin')->findAll();
        return $this->render('@Cabinet/Medecin/profile.html.twig', [
            'medecin' => $medecin
           
        ]);
    }

}