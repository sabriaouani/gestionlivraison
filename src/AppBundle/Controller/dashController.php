<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mission;
use AppBundle\Entity\Client;
use AppBundle\Entity\Produit;
use AppBundle\Form\MissionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Mission controller.
 *
 * @Route("home")
 */
class dashController extends Controller
{
    /**
     * Lists all mission entities.
     *
     * @Route("/", name="mission_dash")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT m
            FROM AppBundle:Mission  m
            ORDER BY m.dateMis desc'
        );
        $query2 = $em->createQuery(
            'SELECT sum(c.prix)
            FROM AppBundle:Client  c
            '
        );

        $missions = $query->execute();
        $prices = $query2->execute();
        return $this->render('dash/dashboard.html.twig', array(

            'missions' => $missions,
            'prices' => $prices,
        ));
    }

}