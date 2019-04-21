<?php

namespace AppBundle\Controller;

use AppBundle\Entity\msg_ch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 * @Route("feedchauf")
 */
class FeedChaufController extends Controller
{
    /**
     * Lists all client entities.
     *
     * @Route("/", name="chauf_feed")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT m
            FROM AppBundle:msg_ch  m
            ORDER BY m.date_m desc'
        );

        $chaufs = $query->execute();
        //$chaufs = $em->getRepository('AppBundle:msg_ch')->findAll();
        dump($chaufs);die;
        return $this->render('feedback/feedChauf.html.twig', array(
            'chaufs' => $chaufs,
        ));
    }
    



}
