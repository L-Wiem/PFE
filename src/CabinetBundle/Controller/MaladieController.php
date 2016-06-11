<?php
/**
 * Created by PhpStorm.
 * User: Wiem
 * Date: 01/04/2016
 * Time: 17:43
 */

namespace CabinetBundle\Controller;



use CabinetBundle\Entity\Maladie;
use CabinetBundle\Form\MaladieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MaladieController extends Controller
{
    public function ajoutAction(Request $request)
    {
        $maladie = new Maladie();
        $form = $this->createForm(new MaladieType(), $maladie);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($maladie);
                $doctrine->getEntityManager()->flush();
                return $this->redirectToRoute('liste_maladies');

            }
        }
        return $this->render('@Cabinet/Maladie/ajout.html.twig', [
            'form' => $form->createView()
        ]);

    }
    public function modifierAction(Request $request, $id)
    {
        $doctrine = $this->getDoctrine();
        $maladie = $doctrine->getRepository('CabinetBundle:Maladie')->find($id);
        $form = $this->createForm(new MaladieType(), $maladie);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($maladie);
                $doctrine->getEntityManager()->flush();
                return $this->redirectToRoute('liste_maladies');

            }
        }
        return $this->render('@Cabinet/Maladie/modifier.html.twig', [
            'form' => $form->createView()
        ]);

    }
    
    public function listeAction()
    {

        $doctrine = $this->getDoctrine();
        $maladies = $doctrine->getRepository('CabinetBundle:Maladie')->findAll();

        return $this->render('@Cabinet/Maladie/liste.html.twig', [
            'maladies' => $maladies
        ]);
    }

    public function supprimerAction($id)
    {

        $doctrine = $this->getDoctrine();
        $maladie = $doctrine->getRepository('CabinetBundle:Maladie')->find($id);
        $doctrine->getEntityManager()->remove($maladie);
        $doctrine->getEntityManager()->flush();

        return $this->redirectToRoute('liste_maladies');
    }
}