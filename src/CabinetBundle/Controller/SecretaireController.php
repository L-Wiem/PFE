<?php

namespace CabinetBundle\Controller;


use CabinetBundle\Entity\Secretaire;
use CabinetBundle\Form\SecretaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecretaireController extends Controller
{
    public function listeAction(){

        $doctrine = $this->getDoctrine();
        $secretaires = $doctrine->getRepository('CabinetBundle:Secretaire')->findAll();

        return $this->render('@Cabinet/Secretaire/liste.html.twig', [
            'secretaires' => $secretaires
        ]);
    }


    public function ajoutAction(Request $request)
    {
        $secretaire = new Secretaire();
        $form = $this->createForm(new SecretaireType(), $secretaire);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $user = $secretaire->getUser();
                $pwd = $user->getPassword();
                $encoder = $this->get('security.password_encoder');
                $pwd = $encoder->encodePassword($user, $pwd);
                $user->setPassword($pwd);
                $user->addRole('ROLE_SECRETAIRE');
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($secretaire);
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "Une nouvelle Secretaire a été créé avec succès !");
                return $this->redirectToRoute('liste_secretaires');
            }
        }
        return $this->render('@Cabinet/Secretaire/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function modifierAction(Request $request, $id)
    {
        $doctrine = $this->getDoctrine();
        $secretaire = $doctrine->getRepository('CabinetBundle:Secretaire')->find($id);
        $form = $this->createForm(new SecretaireType(), $secretaire);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($secretaire);
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "Secretaire modifié avec succès !");
                return $this->redirectToRoute('liste_secretaires');

            }
        }
        return $this->render('@Cabinet/Secretaire/modifier.html.twig', [
            'form' => $form->createView()
        ]);
    }


    public function supprimerAction($id)
    {
        $doctrine = $this->getDoctrine();
        $secretaire = $doctrine->getRepository('CabinetBundle:Secretaire')->find($id);
        $doctrine->getEntityManager()->remove($secretaire);
        $doctrine->getEntityManager()->flush();
        $this->get('session')->getFlashBag()->set('notice_green_panel', "Secretaire supprimé avec succès !");
        return $this->redirectToRoute('liste_secretaires');
    }
}