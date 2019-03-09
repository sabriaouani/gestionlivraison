<?php
/**
 * Created by PhpStorm.
 * User: My PC
 * Date: 09/03/2019
 * Time: 19:14
 */

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Mission;
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
        /** @var Mission $m */
        foreach ($missions as $m ){
            $data[] = array('id'=>$m->getId(),
                'chauffeur'=>$m->getIdChauf()->getNomprenom(),
                'dateDebut'=>$m->getDateMis()->format('d/m/Y'));
        }
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
        /** @var Mission $m */
        foreach ($missions as $m ){
            $data[] = array('id'=>$m->getId(),
                'chauffeur'=>$m->getIdChauf()->getNomprenom(),
                'dateDebut'=>$m->getDateMis()->format('d/m/Y'));
        }
        return new JsonResponse($data);

    }
}