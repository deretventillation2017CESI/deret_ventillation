<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ListeElement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Listeelement controller.
 *
 * @Route("ListeElement")
 */
class ListeElementController extends Controller
{
    /**
     * Lists all listeElement entities.
     *
     * @Route("/", name="ListeElement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listeElements = $em->getRepository('AppBundle:ListeElement')->findAll();

        return $this->render('listeelement/index.html.twig', array(
            'listeElements' => $listeElements,
        ));
    }

    /**
     * Creates a new listeElement entity.
     *
     * @Route("/new", name="ListeElement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $listeElement = new Listeelement();
        $form = $this->createForm('AppBundle\Form\ListeElementType', $listeElement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($listeElement);
            $em->flush();

            return $this->redirectToRoute('ListeElement_show', array('id' => $listeElement->getId()));
        }

        return $this->render('listeelement/new.html.twig', array(
            'listeElement' => $listeElement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a listeElement entity.
     *
     * @Route("/{id}", name="ListeElement_show")
     * @Method("GET")
     */
    public function showAction(ListeElement $listeElement)
    {
        $deleteForm = $this->createDeleteForm($listeElement);

        return $this->render('listeelement/show.html.twig', array(
            'listeElement' => $listeElement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing listeElement entity.
     *
     * @Route("/{id}/edit", name="ListeElement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ListeElement $listeElement)
    {
        $deleteForm = $this->createDeleteForm($listeElement);
        $editForm = $this->createForm('AppBundle\Form\ListeElementType', $listeElement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ListeElement_edit', array('id' => $listeElement->getId()));
        }

        return $this->render('listeelement/edit.html.twig', array(
            'listeElement' => $listeElement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a listeElement entity.
     *
     * @Route("/{id}", name="ListeElement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ListeElement $listeElement)
    {
        $form = $this->createDeleteForm($listeElement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($listeElement);
            $em->flush();
        }

        return $this->redirectToRoute('ListeElement_index');
    }

    /**
     * Creates a form to delete a listeElement entity.
     *
     * @param ListeElement $listeElement The listeElement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ListeElement $listeElement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ListeElement_delete', array('id' => $listeElement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
