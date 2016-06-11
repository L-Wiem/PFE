<?php
/**
 * Created by PhpStorm.
 * User: Wiem
 * Date: 02/05/2016
 * Time: 02:02
 */

namespace CabinetBundle\Controller;


use CabinetBundle\Entity\Maladie;
use CabinetBundle\Entity\Patient;
use CabinetBundle\Form\MaladieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PatientMaladieController extends Controller
{
    public function ajoutAction(Request $request, Patient $patient){
        $maladie= new Maladie();
        $maladie->setPatient($patient);
        $form = $this->createForm(new MaladieType(), $maladie);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($maladie);
                $doctrine->getEntityManager()->flush();
                return new JsonResponse(['status'=> true]);


            }
        }

        return $this->render('@Cabinet/PatientMaladie/ajout.html.twig', [
            'form' => $form->createView(), 'maladie' => $maladie, 'patient' => $patient
        ]);

    }

    public function modifierAction(Request $request, Maladie $maladie)
    {
//        //param converter fait la conversion de l'id envoye par le route en objet analyse
        $form = $this->createForm(new MaladieType(), $maladie);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                //persist n'est pas obligatoire dans le cas de modification d'un objet deja existant
                $doctrine->getEntityManager()->flush();
                return new JsonResponse(['status'=> true]);

            }
        }
        return $this->render('@Cabinet/PatientMaladie/modifier.html.twig', [
            'form' => $form->createView(),
            'maladie' => $maladie
        ]);
    }

    public function supprimerAction($id)
    {
        $doctrine = $this->getDoctrine();
        $maladie= $doctrine->getRepository('CabinetBundle:Maladie')->find($id);
        $doctrine->getEntityManager()->remove($maladie);
        $doctrine->getEntityManager()->flush();
        return new JsonResponse(['status'=> true]);

    }

}