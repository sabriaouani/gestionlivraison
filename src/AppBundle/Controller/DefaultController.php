<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home.html.twig');
    }
    /**
     * @Route("/home", name="userinfo")
     *
     * @security("is_granted('IS_AUTHENTICATED_FULLY')")
     */

    public function ShowInfoUserAction()
    {
        $authCheker = $this->container->get('security.authorization_checker');
        if($authCheker->isGranted('ROLE_ADMIN')){
            return $this->render('chauffeur/dashboard.html.twig');
        }
        else if($authCheker->isGranted('ROLE_USER')){
            return $this->render('mission/gest.html.twig');
        }
        else {
            return $this->render('FOSUserBundle/view/Security/login.html.twig');

        }
    }
}
