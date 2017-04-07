<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Secteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Secteur controller.
 *
 * @Route("secteur")
 */
class SecteurController extends Controller
{
    /**
     * Lists all secteur entities.
     *
     * @Route("/", name="secteur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $secteurs = $em->getRepository('AppBundle:Secteur')->findAll();

        return $this->render('secteur/index.html.twig', array(
            'secteurs' => $secteurs,
        ));
    }

    /**
     * Creates a new secteur entity.
     *
     * @Route("/new", name="secteur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $secteur = new Secteur();
        $form = $this->createForm('AppBundle\Form\SecteurType', $secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($secteur);
            $em->flush();

            return $this->redirectToRoute('secteur_show', array('id' => $secteur->getId()));
        }

        return $this->render('secteur/new.html.twig', array(
            'secteur' => $secteur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a secteur entity.
     *
     * @Route("/{id}", name="secteur_show")
     * @Method("GET")
     */
    public function showAction(Secteur $secteur)
    {
        $deleteForm = $this->createDeleteForm($secteur);

        return $this->render('secteur/show.html.twig', array(
            'secteur' => $secteur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing secteur entity.
     *
     * @Route("/{id}/edit", name="secteur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Secteur $secteur)
    {
        $deleteForm = $this->createDeleteForm($secteur);
        $editForm = $this->createForm('AppBundle\Form\SecteurType', $secteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('secteur_edit', array('id' => $secteur->getId()));
        }

        return $this->render('secteur/edit.html.twig', array(
            'secteur' => $secteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a secteur entity.
     *
     * @Route("/{id}", name="secteur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Secteur $secteur)
    {
        $form = $this->createDeleteForm($secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($secteur);
            $em->flush();
        }

        return $this->redirectToRoute('secteur_index');
    }

    /**
     * Creates a form to delete a secteur entity.
     *
     * @param Secteur $secteur The secteur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Secteur $secteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('secteur_delete', array('id' => $secteur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
