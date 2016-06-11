<?php

namespace CabinetBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\Router;

class RequestListener
{
    protected $doctrine;
    protected $router;
    /**
     * RequestListener constructor.
     */
    public function __construct(Registry $doctrine, Router $router)
    {
        $this->doctrine = $doctrine;
        $this->router = $router;

    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }
        $uri = $event->getRequest()->getRequestUri();

        $medecins = $this->doctrine->getRepository('CabinetBundle:Medecin')->findAll();
        if(!count($medecins) && $uri != $this->router->generate('setup')){
            $response = new RedirectResponse($this->router->generate('setup'));
            $event->setResponse($response);
        }elseif(count($medecins) && $uri == $this->router->generate('setup')){
            $response = new RedirectResponse($this->router->generate('cabinet_homepage'));
            $event->setResponse($response);
        }

    }
}