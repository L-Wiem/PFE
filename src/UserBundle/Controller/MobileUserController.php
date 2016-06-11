<?php

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\MobileUser;

class MobileUserController extends Controller
{
    public function listeAction(){
        $doctrine = $this->getDoctrine();

        $mobileUsers = $doctrine->getRepository('UserBundle:MobileUser')->findBy(

            ["patient" => null]
        );
        return $this->render("@User/MobileUser/liste.html.twig",
            [

                'mobileUsers' => $mobileUsers
            ]);
    }


    public function rejeterAction($id){
        $doctrine = $this->getDoctrine();
        $mobileUser = $doctrine->getRepository('UserBundle:MobileUser')->find($id);
        $doctrine->getEntityManager()->remove($mobileUser);
        $doctrine->getEntityManager()->flush();

        return $this->redirectToRoute('mobile_user');
    }
}