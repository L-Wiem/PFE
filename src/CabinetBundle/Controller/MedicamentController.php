<?php

namespace CabinetBundle\Controller;



use CabinetBundle\Entity\Medicament;
use CabinetBundle\Form\MedicamentRechercheType;
use CabinetBundle\Form\MedicamentType;
use CabinetBundle\Form\Model\RechercheMedicament;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MedicamentController extends Controller
{
    public function ajoutAction(Request $request)
    {
        $medicament = new Medicament();
        $form = $this->createForm(new MedicamentType(), $medicament);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($medicament);
                $doctrine->getEntityManager()->flush();
                return $this->redirectToRoute('liste_medicaments');

            }
        }
        return $this->render('@Cabinet/Medicament/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function modifierAction(Request $request, $id)
    {
        $doctrine = $this->getDoctrine();
        $medicament = $doctrine->getRepository('CabinetBundle:Medicament')->find($id);
        $form = $this->createForm(new MedicamentType(), $medicament);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($medicament);
                $doctrine->getEntityManager()->flush();
                return $this->redirectToRoute('liste_medicaments');

            }
        }
        return $this->render('@Cabinet/Medicament/modifier.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function listeAction(Request $request)
    {
        $rechercheMedicament = new RechercheMedicament();
        $form = $this->createForm(new MedicamentRechercheType(), $rechercheMedicament);
        if($request->isMethod('post')){
            $form->handleRequest($request);
        }
        $doctrine = $this->getDoctrine();
        $medicaments = $doctrine->getRepository('CabinetBundle:Medicament')->chercher($rechercheMedicament);

        return $this->render('@Cabinet/Medicament/liste.html.twig', [
            'medicaments' => $medicaments,
            'form' => $form->createView()
        ]);
    }

    public function supprimerAction($id)
    {
        $doctrine = $this->getDoctrine();
        $medicament = $doctrine->getRepository('CabinetBundle:Medicament')->find($id);
        $doctrine->getEntityManager()->remove($medicament);
        $doctrine->getEntityManager()->flush();

        return $this->redirectToRoute('liste_medicaments');
    }
}