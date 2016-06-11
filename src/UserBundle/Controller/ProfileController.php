<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\ProfileType;
use UserBundle\Form\UserPasswordType;

class ProfileController extends Controller
{
    public function afficherAction()
    {
        return $this->render("@User/profile/afficher.html.twig");
    }

    public function modifierPasswordAction(Request $request, $id)
    {

        $doctrine = $this->getDoctrine();

        $user = $doctrine->getRepository('UserBundle:User')->find($id);
        $form = $this->createForm(new UserPasswordType(), $user);
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $pwd = $user->getPassword();
                $encoder = $this->get('security.password_encoder');
                $pwd = $encoder->encodePassword($user, $pwd);
                $user->setPassword($pwd);
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "Votre mot de passe a été modifié avec succès !");
                return $this->redirectToRoute('afficher_profile');

            }
        }
        return $this->render("@User/profile/modifierPassword.html.twig", [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    public function modifierProfileAction(Request $request, $id)
    {
        $doctrine = $this->getDoctrine();
        $user = $doctrine->getRepository('UserBundle:User')->find($id);
        if ($user->getMedecin()) {
            $medecin = $doctrine->getRepository('CabinetBundle:Medecin')->find($user->getMedecin()->getId());
            $form = $this->createForm(new ProfileType(), $medecin, [
                'data_class' => 'CabinetBundle\Entity\Medecin'
            ]);
        } else {
            $secretaire = $doctrine->getRepository('CabinetBundle:Secretaire')->find($user->getSecretaire()->getId());
            $form = $this->createForm(new ProfileType(), $secretaire, [
                'data_class' => 'CabinetBundle\Entity\Secretaire'
            ]);
        }
        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $doctrine = $this->getDoctrine();
                $doctrine->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->set('notice_green_panel', "Votre profile a été modifié avec succès !");
                return $this->redirectToRoute('afficher_profile');

            }
        }
        return $this->render("@User/profile/modifierProfile.html.twig", [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
