<?php


namespace CabinetBundle\Controller;


use CabinetBundle\Entity\Antecedent;
use CabinetBundle\Entity\Consultation;
use CabinetBundle\Form\AntecedentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AntecedentController extends Controller
{
public function ajoutAction(Request $request, Consultation $consultation){

    $antecedent= new Antecedent();
    $antecedent->setPatient($consultation->getPatient());
    $form = $this->createForm(new AntecedentType(), $antecedent);
    if ($request->isMethod("post")) {
        $form->handleRequest($request);
        if ($form->isValid()) {
            $doctrine = $this->getDoctrine();
            $doctrine->getEntityManager()->persist($antecedent);
            $doctrine->getEntityManager()->flush();
            return new JsonResponse(['status'=> true]);


        }
    }

    return $this->render('@Cabinet/Antecedent/ajout.html.twig', [
        'form' => $form->createView(), 'consultation' => $consultation
    ]);
}


    public function modifierAction(Request $request, Antecedent $antecedent)
    {
        //param converter fait la conversion de l'id envoye par le route en objet analyse
        $form = $this->createForm(new AntecedentType(), $antecedent);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                //persist n'est pas obligatoire dans le cas de modification d'un objet deja existant
                $doctrine->getEntityManager()->flush();
                return new JsonResponse(['status'=> true]);

            }
        }
        return $this->render('@Cabinet/Antecedent/modifier.html.twig', [
            'form' => $form->createView(), 'antecedent' => $antecedent
        ]);
    }

    public function supprimerAction($id)
    {
        $doctrine = $this->getDoctrine();
        $antecedent= $doctrine->getRepository('CabinetBundle:Antecedent')->find($id);
        $doctrine->getEntityManager()->remove($antecedent);
        $doctrine->getEntityManager()->flush();
        return new JsonResponse(['status'=> true]);

    }
}