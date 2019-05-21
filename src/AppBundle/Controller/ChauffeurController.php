<?php

namespace AppBundle\Controller;

use AppBundle\Entity\chauffeur;
use Doctrine\DBAL\Types\StringType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Chauffeur controller.
 *
 * @Route("chauffeur")
 */
class ChauffeurController extends Controller
{
    /**
     * Lists all chauffeur entities.
     *
     * @Route("/", name="chauffeur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT c
            FROM AppBundle:chauffeur c
            where c.status= :status')->setParameter('status',false);


        $chauffeurs = $query->execute();

        $gestionnairess = $em->getRepository('AppBundle:Gestionnaire')->findAll();
        return $this->render('chauffeur/index.html.twig', array(
            'chauffeurs' => $chauffeurs,
            'gestionnairess' => $gestionnairess,

        ));
    }

    /**
     * Creates a new chauffeur entity.
     *
     * @Route("/new", name="chauffeur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $chauffeur = new Chauffeur();
        $form = $this->createForm('AppBundle\Form\ChauffeurType', $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $chauffeur ->setStatus("false");
            $em->persist($chauffeur);
            $em->flush();
            $this->addFlash('message','Chauffeur ajouter');



            return $this->redirectToRoute('chauffeur_show', array('id' => $chauffeur->getId()));
        }

        return $this->render('chauffeur/new.html.twig', array(
            'chauffeur' => $chauffeur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a chauffeur entity.
     *
     * @Route("/{id}", name="chauffeur_show")
     * @Method("GET")
     */
    public function showAction(Chauffeur $chauffeur)
    {

        $deleteForm = $this->createDeleteForm($chauffeur);
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT DISTINCT g.nomprenom
    FROM AppBundle:chauffeur c
    LEFT JOIN AppBundle:Gestionnaire g
    WITH c.idGest = g.id
    '
        );

        $gests = $query->execute();
        return $this->render('chauffeur/show.html.twig', array(
            'chauffeur' => $chauffeur,
            'gests' => $gests,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing chauffeur entity.
     *
     * @Route("/{id}/edit", name="chauffeur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Chauffeur $chauffeur)
    {
        $deleteForm = $this->createDeleteForm($chauffeur);
        $editForm = $this->createForm('AppBundle\Form\ChauffeurType', $chauffeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('message','Chauffeur modifier');

            return $this->redirectToRoute('chauffeur_index', array('id' => $chauffeur->getId()));
        }

        return $this->render(':chauffeur:edit.html.twig', array(
            'chauffeur' => $chauffeur,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));


    }

    /**
     * Deletes a chauffeur entity.
     *
     * @Route("/delete/chauffeur", name="chauffeur_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $chauffeur = $em->getRepository('AppBundle:chauffeur')->find($id);


        $chauffeur->setStatus(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($chauffeur);
            $em->flush();
            $this->addFlash('message', 'Chauffeur supprimer');


            return $this->redirectToRoute('chauffeur_index');


        //}

      //  return $this->render(':chauffeur:index.html.twig');


    }

    /**
     * Creates a form to delete a chauffeur entity.
     *
     * @param Chauffeur $chauffeur The chauffeur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Chauffeur $chauffeur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chauffeur_delete', array('id' => $chauffeur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
