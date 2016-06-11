<?php

namespace CabinetBundle\Controller;

use CabinetBundle\Entity\Medecin;
use CabinetBundle\Form\MedecinType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends Controller
{
    
    public function setupAction(Request $request)
    {
        $medecin = new Medecin();
        $form = $this->createForm(new MedecinType(), $medecin);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $user = $medecin->getUser();
                $pwd = $user->getPassword();
                $encoder = $this->get('security.password_encoder');
                $pwd = $encoder->encodePassword($user, $pwd);
                $user->setPassword($pwd);
                $user->addRole('ROLE_MEDECIN');
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($medecin);
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "Compte du Médecin a été créé avec succès !");
                return $this->redirectToRoute('login');

            }
        }
        return $this->render('@Cabinet/Accueil/setup.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
