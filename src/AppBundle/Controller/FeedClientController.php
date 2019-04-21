<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\msg_ch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 * @Route("feedclient")
 */
class FeedClientController extends Controller
{
    /**
     * Lists all client entities.
     *
     * @Route("/", name="client_feed")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $clients = $em->getRepository('AppBundle:Client')->findAll();

        return $this->render('feedback/feedClient.html.twig', array(
            'clients' => $clients,
        ));
    }
    



}
