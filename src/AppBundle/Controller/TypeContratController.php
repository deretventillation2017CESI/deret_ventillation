<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypeContrat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typecontrat controller.
 *
 * @Route("typeContrat")
 */
class TypeContratController extends Controller
{
    /**
     * Lists all typeContrat entities.
     *
     * @Route("/", name="typeContrat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeContrats = $em->getRepository('AppBundle:TypeContrat')->findAll();

        return $this->render('typecontrat/index.html.twig', array(
            'typeContrats' => $typeContrats,
        ));
    }

    /**
     * Creates a new typeContrat entity.
     *
     * @Route("/new", name="typeContrat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeContrat = new Typecontrat();
        $form = $this->createForm('AppBundle\Form\TypeContratType', $typeContrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeContrat);
            $em->flush();

            return $this->redirectToRoute('typeContrat_show', array('id' => $typeContrat->getId()));
        }

        return $this->render('typecontrat/new.html.twig', array(
            'typeContrat' => $typeContrat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeContrat entity.
     *
     * @Route("/{id}", name="typeContrat_show")
     * @Method("GET")
     */
    public function showAction(TypeContrat $typeContrat)
    {
        $deleteForm = $this->createDeleteForm($typeContrat);

        return $this->render('typecontrat/show.html.twig', array(
            'typeContrat' => $typeContrat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeContrat entity.
     *
     * @Route("/{id}/edit", name="typeContrat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypeContrat $typeContrat)
    {
        $deleteForm = $this->createDeleteForm($typeContrat);
        $editForm = $this->createForm('AppBundle\Form\TypeContratType', $typeContrat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typeContrat_edit', array('id' => $typeContrat->getId()));
        }

        return $this->render('typecontrat/edit.html.twig', array(
            'typeContrat' => $typeContrat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeContrat entity.
     *
     * @Route("/{id}", name="typeContrat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypeContrat $typeContrat)
    {
        $form = $this->createDeleteForm($typeContrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeContrat);
            $em->flush();
        }

        return $this->redirectToRoute('typeContrat_index');
    }

    /**
     * Creates a form to delete a typeContrat entity.
     *
     * @param TypeContrat $typeContrat The typeContrat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeContrat $typeContrat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typeContrat_delete', array('id' => $typeContrat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
