<?php
/**
 * Created by PhpStorm.
 * User: My PC
 * Date: 09/03/2019
 * Time: 19:14
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\chauffeur;
use AppBundle\Entity\Client;
use AppBundle\Entity\Mission;
use AppBundle\Entity\Produit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Mission Api controller.
 *
 * @Route("api/mission")
 */
class MissionApiController extends Controller
{
    /**
     * Lists all mission entities.
     *
     * @Route("/all", name="mission_api_all")
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


        $missions = $query->execute();
        $data = array();
        $missionarray = array();
        /** @var Mission $m */
        /** @var Client $client */
        /** @var Produit $produit */
      foreach ($missions as $m ){
            //foreach ($m->getIdClient() as $client ){
            //foreach ($client->getIdProduit() as $produit ){

                $missionarray[] = array('id'=>$m->getId(),
                'chauffeur'=>$m->getIdChauf()->getNomprenom(),
                'dateMission'=>$m->getDateMis()->format('d/m/Y'),
                );
                  //  'Nom produit' =>array($produit->getNomProduit()));

        }
        $clientarray = array();
        foreach ($missions as $m ){
            foreach ($m->getIdClient() as $client ){

                $clientarray[] = array( 'nomClients' =>$client->getNom()  ,
                    'adressClients' =>$client->getAdress(),
                    'prixClients' =>$client->getPrix(),
                    'telClients' =>$client->getTel());
            }
        }
       // $data[]= array_merge ( $missionarray , $clientarray );
        $data[] = array($missionarray + $clientarray);

        return new JsonResponse($data);

    }


    /**
     *
     * @Route("/today", name="mission_api_date")
     * @Method("GET")
     */
    public function getMissionTodayAction(Request $request)
    {
      // $date =$request->query->get('date');
        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime('now');
        $dateBegin = $date->format('Y-m-d 00:00:00');
        $dateFin = $date->format('Y-m-d 23:59:59');

        $query = $em->createQuery(
            'SELECT m
            FROM AppBundle:Mission  m
            WHERE m.dateMis >= :dateDebut and m.dateMis< :dateFin
            ORDER BY m.dateMis desc'
        )->setParameter('dateDebut',$dateBegin)->setParameter('dateFin',$dateFin);

        $missions = $query->execute();
        $data = array();
        $missionarray = array();
        $clientarray = array();
        /** @var Mission $m */
        /** @var Client $client */
        /** @var Produit $produit */
        foreach ($missions as $m ){
            $data[] = array('id'=>$m->getId(),
                'chauffeur'=>$m->getIdChauf()->getNomprenom(),
                'dateMission'=>$m->getDateMis()->format('d/m/Y'),
            );}
        foreach ($missions as $m ){

            foreach ($m->getIdClient() as $client ){

                $data[] = array( 'nomClients' =>$client->getNom()  ,
                    'adressClients' =>$client->getAdress(),
                    'prixClients' =>$client->getPrix(),
                    'telClients' =>$client->getTel());
            }

        }
        foreach ($missions as $m ) {

            foreach ($m->getIdClient() as $client) {
                foreach ($client->getIdProduit() as $produit) {
                    $data[] = array( 'Nom produit' =>array($produit->getNomProduit()));
                }

            }
        }


        $data[] = array($missionarray + $clientarray);

        // $data[]= array_merge ( $missionarray , $clientarray );
        return new JsonResponse($data);

    }
    /**
     *
     * @Route("/loginChauff", name="LoginChauff_api_date")
     * @Method("GET")
     */
    public function LoginChauffeurAction(Request $request)
    {
        // $date =$request->query->get('date');
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT m
            FROM AppBundle:chauffeur m
            '
        );

        $chauffeurs = $query->execute();
        $data = array();
        /** @var chauffeur $m */
        foreach ($chauffeurs as $m ){
            $data[] = array('id'=>$m->getId(),
                'adress'=>$m->getNomprenom(),
                'mdp'=>$m->getCin());
        }
        return new JsonResponse($data);

    }
    /**
     *
     * @Route("/loginClient", name="LoginClient_api_date")
     * @Method("GET")
     */
    public function LoginClientAction(Request $request)
    {
       // $adress =$request->query->get('adress');
       // $mdp =$request->query->get('mdp');
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT m
            FROM AppBundle:Client m
            '
        );

        $clients = $query->execute();
        $data = array();
        /** @var Client $m */
        foreach ($clients as $m ){
            $data[] = array('id'=>$m->getId(),
                'adress'=>$m->getNom(),
                'mdp'=>$m->getTel());
        }
        return new JsonResponse($data);

    }
}