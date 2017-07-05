<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlageHoraire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Typehoraire controller.
 *
 * @Route("plageHoraire")
 */
class PlageHoraireController extends Controller
{
    /**
     * Lists all typeHoraire entities.
     *
     * @Route("/", name="plageHoraire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeHoraires = $em->getRepository('AppBundle:PlageHoraire')->findAll();

        return $this->render('plagehoraire/index.html.twig', array(
            'typeHoraires' => $typeHoraires,
        ));
    }

    /**
     * Creates a new typeHoraire entity.
     *
     * @Route("/new", name="typeHoraire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeHoraire = new PlageHoraire();
        $form = $this->createForm('AppBundle\Form\TypeHoraireType', $typeHoraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeHoraire);
            $em->flush();

            return $this->redirectToRoute('typeHoraire_show', array('id' => $typeHoraire->getId()));
        }

        return $this->render('plagehoraire/new.html.twig', array(
            'typeHoraire' => $typeHoraire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeHoraire entity.
     *
     * @Route("/{id}", name="typeHoraire_show")
     * @Method("GET")
     */
    public function showAction(PlageHoraire $typeHoraire)
    {
        $deleteForm = $this->createDeleteForm($typeHoraire);

        return $this->render('plagehoraire/show.html.twig', array(
            'typeHoraire' => $typeHoraire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeHoraire entity.
     *
     * @Route("/{id}/edit", name="typeHoraire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PlageHoraire $typeHoraire)
    {
        $deleteForm = $this->createDeleteForm($typeHoraire);
        $editForm = $this->createForm('AppBundle\Form\TypeHoraireType', $typeHoraire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typeHoraire_edit', array('id' => $typeHoraire->getId()));
        }

        return $this->render('plagehoraire/edit.html.twig', array(
            'typeHoraire' => $typeHoraire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeHoraire entity.
     *
     * @Route("/{id}", name="typeHoraire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PlageHoraire $typeHoraire)
    {
        $form = $this->createDeleteForm($typeHoraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeHoraire);
            $em->flush();
        }

        return $this->redirectToRoute('typeHoraire_index');
    }

    /**
     * Creates a form to delete a typeHoraire entity.
     *
     * @param PlageHoraire $typeHoraire The typeHoraire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PlageHoraire $typeHoraire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typeHoraire_delete', array('id' => $typeHoraire->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
