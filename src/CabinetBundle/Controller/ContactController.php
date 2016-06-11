<?php

namespace CabinetBundle\Controller;


use CabinetBundle\Entity\Contact;
use CabinetBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
        public function listeAction(){

            $doctrine = $this->getDoctrine();
            $contacts = $doctrine->getRepository('CabinetBundle:Contact')->findAll();

            return $this->render('@Cabinet/Contact/liensUtiles.html.twig', [
                'contacts' => $contacts
            ]);
        }

    public function ajoutAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->persist($contact);
                $doctrine->getEntityManager()->flush();
                return $this->redirectToRoute('liens_utiles');
            }
        }
        return $this->render('@Cabinet/Contact/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
        
    }