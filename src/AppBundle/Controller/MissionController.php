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
 * @Route("mission")
 */
class MissionController extends Controller
{
    /**
     * Lists all mission entities.
     *
     * @Route("/", name="mission_index")
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
        return $this->render('mission/index.html.twig', array(

            'missions' => $missions,
        ));
    }


    /**
     * Creates a new mission entity.
     *
     * @Route("/new", name="mission_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * var $mission Mission
         */



        $mission= new Mission();
        // $client = $em->getRepository('AppBundle:Client')->find($id);
/*
         $originalclient= new ArrayCollection();
         foreach ($mission->getIdClient() as $client){
             $originalclient->add($client);
         } */

        $form = $this->createForm(MissionType::class, $mission);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
          /* foreach ($originalclient as $client){
                dump($mission->getIdClient()->contains($client));
                if($mission->getIdClient()->contains($client) === false){
                    $em->remove($client);

                    // if it was a many-to-one relationship, remove the relationship like this
                    // $tag->setTask(null);

                   // $em->persist($client);

                }
            } */


            $em->persist($mission);
            $em->flush();
            return $this->redirectToRoute('mission_index');
        }


        return $this->render('mission/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a mission entity.
     *
     * @Route("/{id}", name="mission_show")
     * @Method("GET")
     */
    public function showAction(Mission $mission)
    {
        $deleteForm = $this->createDeleteForm($mission);

        return $this->render('mission/show.html.twig', array(
            'mission' => $mission,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing mission entity.
     *
     * @Route("/{id}/edit", name="mission_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Mission $mission)
    {
        $deleteForm = $this->createDeleteForm($mission);
        $editForm = $this->createForm('AppBundle\Form\MissionType', $mission);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mission_index');
        }

        return $this->render('mission/edit.html.twig', array(
            'mission' => $mission,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a mission entity.
     *
     * @Route("/delete/{id}", name="mission_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Mission')->find($id);
        $em->remove($post);
        $em->flush();
        $this->addFlash('message', 'Mission deleted');


        return $this->redirectToRoute('mission_index');

    }

    /**
     * Creates a form to delete a mission entity.
     *
     * @param Mission $mission The mission entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mission $mission)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mission_delete', array('id' => $mission->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
