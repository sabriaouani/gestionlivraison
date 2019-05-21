<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Produit;
use AppBundle\Entity\TypeProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Produit controller.
 *
 * @Route("produit")
 */
class ProduitController extends Controller
{
    /**
     * Lists all produit entities.
     *
     * @Route("/", name="produit_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //$prod = $em->getRepository('AppBundle:Produit')->findAll();

        $query = $em->createQuery(
            'SELECT p
            FROM AppBundle:Produit p
            where p.status= :status')->setParameter('status',false);


        $produits = $query->execute();       /* if($request->isMethod('POST')){
            $nom=$request->get('nomProduit');
            $produits=$em->getRepository('AppBundle:Produit')->findBy(array('nomProduit'=>$nom));
        }
        $query = $em->createQuery(
            'SELECT DISTINCT t.type
    FROM AppBundle:Produit p
    LEFT JOIN AppBundle:TypeProduit t
    WITH p.IdType = t.id
    '
        );

        $products = $query->execute(); */


        return $this->render('produit/index.html.twig', array(
            'produits' => $produits,
           // 'products' => $products,
           // 'prod'=>$prod,

        ));
    }

    /**
     * Creates a new produit entity.
     *
     * @Route("/new", name="produit_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('AppBundle\Form\ProduitType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $produit->setStatus("false");
            $em->persist($produit);
            $em->flush();
            $this->addFlash('message','Produit Ajouter');

            return $this->redirectToRoute('produit_index', array('id' => $produit->getId()));
        }

        return $this->render('produit/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produit entity.
     *
     * @Route("/{id}", name="produit_show")
     * @Method("GET")
     */
    public function showAction(Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);

        return $this->render('produit/show.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     * @Route("/{id}/edit", name="produit_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('AppBundle\Form\ProduitType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('message','Produit Modifier');

            return $this->redirectToRoute('produit_index', array('id' => $produit->getId()));
        }

        return $this->render('produit/edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     * @Route("/delete/produit", name="produit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('AppBundle:Produit')->find($id);
        //$em->remove($post);

        $produit->setStatus(true);
        $em->persist($produit);

        $em->flush();
        $this->addFlash('message','Produit supprimer');


        return $this->redirectToRoute('produit_index');
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param Produit $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
