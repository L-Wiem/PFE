<?php
namespace CabinetBundle\Controller;


use CabinetBundle\Entity\Consultation;
use CabinetBundle\Entity\Ordonnance;
use CabinetBundle\Form\ConsultationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConsultationController extends Controller
{
    public function commencerAction(Request $request, $id)
    {
        $doctrine = $this->getDoctrine();
        $rdv= $doctrine->getRepository('CabinetBundle:Rdv')->find($id);
        $patient = $rdv->getPatient();
        if($rdv->getConsultation()==null) {
            $consultation = new Consultation();
            $rdv->setConsultation($consultation);
            $consultation->setPatient($rdv->getPatient());
            $ordonnance= new Ordonnance();
            $consultation->setOrdonnance($ordonnance);
            $doctrine->getEntityManager()->persist($consultation);
            $doctrine->getEntityManager()->flush();
        }
        else{
            $consultation=$rdv->getConsultation();
        }
        $form = $this->createForm(new ConsultationType(), $consultation);
        //formulaire submitted
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "Consultation sauvgardée avec succès !");
                return $this->redirectToRoute('liste_rdv');
            }
        }

        return $this->render('@Cabinet/Consultation/commencer.html.twig', [
            'form' => $form->createView(), 'rdv' => $rdv, 'consultation' => $consultation, 'patient' => $patient
        ]);

    }
    public function imprimerOrdonnanceAction($id){
        $doctrine = $this->getDoctrine();
        $consultation= $doctrine->getRepository('CabinetBundle:Consultation')->find($id);
        $ordonnance = $consultation->getOrdonnance();
        $rdv = $consultation->getRdv();
        return $this->render('@Cabinet/Ordonnance/impression.html.twig', [
        'ordonnance' => $ordonnance, 'rdv' => $rdv
        ]);
    }
   

}