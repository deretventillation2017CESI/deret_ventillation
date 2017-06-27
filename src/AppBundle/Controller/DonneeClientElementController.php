<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DonneeClientElement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Donneeclientelement controller.
 *
 * @Route("donneeclientelement")
 */
class DonneeClientElementController extends Controller
{
    /**
     * Lists all donneeClientElement entities.
     *
     * @Route("/", name="donneeclientelement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $donneeClientElements = $em->getRepository('AppBundle:DonneeClientElement')->findAll();

        return $this->render('donneeclientelement/index.html.twig', array(
            'donneeClientElements' => $donneeClientElements,
        ));
    }

    /**
     * Creates a new donneeClientElement entity.
     *
     * @Route("/new", name="donneeclientelement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $donneeClientElement = new Donneeclientelement();
        $form = $this->createForm('AppBundle\Form\DonneeClientElementType', $donneeClientElement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($donneeClientElement);
            $em->flush();

            return $this->redirectToRoute('donneeclientelement_show', array('id' => $donneeClientElement->getId()));
        }

        return $this->render('donneeclientelement/new.html.twig', array(
            'donneeClientElement' => $donneeClientElement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a donneeClientElement entity.
     *
     * @Route("/{id}", name="donneeclientelement_show")
     * @Method("GET")
     */
    public function showAction(DonneeClientElement $donneeClientElement)
    {
        $deleteForm = $this->createDeleteForm($donneeClientElement);

        return $this->render('donneeclientelement/show.html.twig', array(
            'donneeClientElement' => $donneeClientElement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing donneeClientElement entity.
     *
     * @Route("/{id}/edit", name="donneeclientelement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DonneeClientElement $donneeClientElement)
    {
        $deleteForm = $this->createDeleteForm($donneeClientElement);
        $editForm = $this->createForm('AppBundle\Form\DonneeClientElementType', $donneeClientElement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('donneeclientelement_edit', array('id' => $donneeClientElement->getId()));
        }

        return $this->render('donneeclientelement/edit.html.twig', array(
            'donneeClientElement' => $donneeClientElement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a donneeClientElement entity.
     *
     * @Route("/{id}", name="donneeclientelement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DonneeClientElement $donneeClientElement)
    {
        $form = $this->createDeleteForm($donneeClientElement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($donneeClientElement);
            $em->flush();
        }

        return $this->redirectToRoute('donneeclientelement_index');
    }

    /**
     * Creates a form to delete a donneeClientElement entity.
     *
     * @param DonneeClientElement $donneeClientElement The donneeClientElement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DonneeClientElement $donneeClientElement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('donneeclientelement_delete', array('id' => $donneeClientElement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
