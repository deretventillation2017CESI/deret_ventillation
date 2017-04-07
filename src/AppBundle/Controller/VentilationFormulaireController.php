<?php

namespace AppBundle\Controller;

use AppBundle\Entity\VentilationFormulaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ventilationformulaire controller.
 *
 * @Route("ventilationformulaire")
 */
class VentilationFormulaireController extends Controller
{
    /**
     * Lists all ventilationFormulaire entities.
     *
     * @Route("/", name="ventilationformulaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ventilationFormulaires = $em->getRepository('AppBundle:VentilationFormulaire')->findAll();

        return $this->render('ventilationformulaire/index.html.twig', array(
            'ventilationFormulaires' => $ventilationFormulaires,
        ));
    }

    /**
     * Creates a new ventilationFormulaire entity.
     *
     * @Route("/new", name="ventilationformulaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ventilationFormulaire = new Ventilationformulaire();
        $form = $this->createForm('AppBundle\Form\VentilationFormulaireType', $ventilationFormulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ventilationFormulaire);
            $em->flush();

            return $this->redirectToRoute('ventilationformulaire_show', array('id' => $ventilationFormulaire->getId()));
        }

        return $this->render('ventilationformulaire/new.html.twig', array(
            'ventilationFormulaire' => $ventilationFormulaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ventilationFormulaire entity.
     *
     * @Route("/{id}", name="ventilationformulaire_show")
     * @Method("GET")
     */
    public function showAction(VentilationFormulaire $ventilationFormulaire)
    {
        $deleteForm = $this->createDeleteForm($ventilationFormulaire);

        return $this->render('ventilationformulaire/show.html.twig', array(
            'ventilationFormulaire' => $ventilationFormulaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ventilationFormulaire entity.
     *
     * @Route("/{id}/edit", name="ventilationformulaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, VentilationFormulaire $ventilationFormulaire)
    {
        $deleteForm = $this->createDeleteForm($ventilationFormulaire);
        $editForm = $this->createForm('AppBundle\Form\VentilationFormulaireType', $ventilationFormulaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ventilationformulaire_edit', array('id' => $ventilationFormulaire->getId()));
        }

        return $this->render('ventilationformulaire/edit.html.twig', array(
            'ventilationFormulaire' => $ventilationFormulaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ventilationFormulaire entity.
     *
     * @Route("/{id}", name="ventilationformulaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, VentilationFormulaire $ventilationFormulaire)
    {
        $form = $this->createDeleteForm($ventilationFormulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ventilationFormulaire);
            $em->flush();
        }

        return $this->redirectToRoute('ventilationformulaire_index');
    }

    /**
     * Creates a form to delete a ventilationFormulaire entity.
     *
     * @param VentilationFormulaire $ventilationFormulaire The ventilationFormulaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VentilationFormulaire $ventilationFormulaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ventilationformulaire_delete', array('id' => $ventilationFormulaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
