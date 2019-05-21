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
 * @Route("exist")
 */
class ExistController extends Controller
{
    /**
     * Lists all client entities.
     *
     * @Route("/", name="exist_produit")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $exists = $em->getRepository('AppBundle:ProClient')->findAll();
        foreach ($exists as $e){

            $client = $em->getRepository('AppBundle:Client')->find($e->getIdClient());
            $e->setNomclient($client->getNom());
            $em->persist($e);
            $em->flush();
        }
        foreach ($exists as $p){

            $produit = $em->getRepository('AppBundle:Produit')->find($p->getIdProduit());
            $p->setNomproduit($produit->getNomProduit());
            $em->persist($p);
            $em->flush();
        }
        return $this->render('feedback/Exist.html.twig', array(
            'exists' => $exists,
        ));
    }
    



}
