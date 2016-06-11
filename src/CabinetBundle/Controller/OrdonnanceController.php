<?php


namespace CabinetBundle\Controller;


use CabinetBundle\Entity\Prescription;
use CabinetBundle\Entity\Ordonnance;
use CabinetBundle\Form\PrescriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OrdonnanceController extends Controller
{
    public function ajoutMedicamentAction(Request $request, Ordonnance $ordonnance)
    {

        $prescription = new Prescription();
        $prescription->setOrdonnance($ordonnance);
        $form = $this->createForm(new PrescriptionType(), $prescription);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($prescription);
                $doctrine->getEntityManager()->flush();
                return new JsonResponse(['status' => true]);
            }
        }

        return $this->render('@Cabinet/Ordonnance/ajout.html.twig', [
            'form' => $form->createView(), 'ordonnance' => $ordonnance
        ]);

    }

    public function modifierMedicamentAction(Request $request, Prescription $prescription)
    {
        //param converter fait la conversion de l'id envoye par le route en objet analyse
        $form = $this->createForm(new PrescriptionType(), $prescription);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                //persist n'est pas obligatoire dans le cas de modification d'un objet deja existant
                $doctrine->getEntityManager()->flush();
                return new JsonResponse(['status' => true]);

            }
        }
        return $this->render('@Cabinet/Ordonnance/modifier.html.twig', [
            'form' => $form->createView(),
            'prescription' => $prescription
        ]);
    }

    public function supprimerMedicamentAction($id)
    {
        $doctrine = $this->getDoctrine();
        $prescription = $doctrine->getRepository('CabinetBundle:Prescription')->find($id);
        $doctrine->getEntityManager()->remove($prescription);
        $doctrine->getEntityManager()->flush();
        return new JsonResponse(['status' => true]);

    }


}