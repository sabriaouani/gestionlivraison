<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gestionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Gestionnaire controller.
 *
 * @Route("gestionnaire")
 */
class GestionnaireController extends Controller
{
    /**
     * Lists all gestionnaire entities.
     *
     * @Route("/", name="gestionnaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gestionnaires = $em->getRepository('AppBundle:Gestionnaire')->findAll();

        return $this->render('gestionnaire/index.html.twig', array(
            'gestionnaires' => $gestionnaires,

        ));
    }

    /**
     * Creates a new gestionnaire entity.
     *
     * @Route("/new", name="gestionnaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gestionnaire = new Gestionnaire();
        $form = $this->createForm('AppBundle\Form\GestionnaireType', $gestionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gestionnaire);
            $em->flush();

            return $this->redirectToRoute('gestionnaire_index', array('id' => $gestionnaire->getId()));
        }

        return $this->render('gestionnaire/new.html.twig', array(
            'gestionnaire' => $gestionnaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gestionnaire entity.
     *
     * @Route("/{id}", name="gestionnaire_show")
     * @Method("GET")
     */
    public function showAction(Gestionnaire $gestionnaire)
    {
        $deleteForm = $this->createDeleteForm($gestionnaire);
        $em = $this->getDoctrine()->getManager();


        return $this->render('gestionnaire/show.html.twig', array(
            'gestionnaire' => $gestionnaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gestionnaire entity.
     *
     * @Route("/{id}/edit", name="gestionnaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gestionnaire $gestionnaire)
    {
        $deleteForm = $this->createDeleteForm($gestionnaire);
        $editForm = $this->createForm('AppBundle\Form\GestionnaireType', $gestionnaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gestionnaire_index', array('id' => $gestionnaire->getId()));
        }

        return $this->render('gestionnaire/edit.html.twig', array(
            'gestionnaire' => $gestionnaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gestionnaire entity.
     *
     * @Route("/delete/{id}", name="gestionnaire_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Gestionnaire')->find($id);
        $em->remove($post);
        $em->flush();
        $this->addFlash('message','Gestionnaire supprimer');

        return $this->redirectToRoute('gestionnaire_index');
    }

    /**
     * Creates a form to delete a gestionnaire entity.
     *
     * @param Gestionnaire $gestionnaire The gestionnaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gestionnaire $gestionnaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gestionnaire_delete', array('id' => $gestionnaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
