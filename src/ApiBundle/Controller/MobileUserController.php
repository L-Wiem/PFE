<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\MobileUser;

class MobileUserController extends Controller
{
    public function ajoutAction(Request $request)
    {
        $pnom = $request->request->get('txtnom');
        $pprenom = $request->request->get('txtprenom');
        $pgenre = $request->request->get('txtgenre');
        $pusername = $request->request->get('txtusername');
        $ppassword = $request->request->get('txtpassword');

        if ($pnom && $pprenom && $pgenre && $pusername && $ppassword) {
            $userMobile = new MobileUser();
            $userMobile->setNom($pnom);
            $userMobile->setPrenom($pprenom);
            $userMobile->setGenre($pgenre);
            $userMobile->setUsername($pusername);
            $userMobile->setPassword($ppassword);
            $doctrine = $this->getDoctrine();
            $doctrine->getEntityManager()->persist($userMobile);
            $doctrine->getEntityManager()->flush();
            return new Response("Succe");
        } else {
            return new Response("erreur");
        }
    }

    public function loginAction(Request $request)
    {
        $txtUsername = $request->request->get('txtUsername');
        $txtPassword = $request->request->get('txtPassword');

        if ($txtUsername && $txtPassword) {
            $doctrine = $this->getDoctrine();
            $mobileUser = $doctrine->getRepository('UserBundle:MobileUser')->findOneBy([
                'username' => $txtUsername,
                'password' => $txtPassword,
            ]);
            if ($mobileUser) {
                return new Response("success");
            }
        }
        return new Response("Nom d'utilisateur ou mot de passe incorrect");

    }

    public function setDeviceIDAction(Request $request)
    {
        $action = $request->request->get('action');
        if ($action == "add") {
            $txtUsername = $request->request->get('txtUsername');
            $tokenid = $request->request->get('tokenid');

            if ($txtUsername && $tokenid) {
                $doctrine = $this->getDoctrine();
                $mobileUser = $doctrine->getRepository('UserBundle:MobileUser')->findOneBy(['username' => $txtUsername]);
                if ($mobileUser) {
                    $mobileUser->setDeviceId($tokenid);
                    $doctrine->getEntityManager()->flush();
                    return new Response("Device Id UPDATED successfully");
                }
            }
        }
        return new Response();
    }
}