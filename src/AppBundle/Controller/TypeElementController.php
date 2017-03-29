<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypeElement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typeelement controller.
 *
 * @Route("typeElement")
 */
class TypeElementController extends Controller
{
    /**
     * Lists all typeElement entities.
     *
     * @Route("/", name="typeElement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeElements = $em->getRepository('AppBundle:TypeElement')->findAll();

        return $this->render('typeelement/index.html.twig', array(
            'typeElements' => $typeElements,
        ));
    }

    /**
     * Creates a new typeElement entity.
     *
     * @Route("/new", name="typeElement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeElement = new Typeelement();
        $form = $this->createForm('AppBundle\Form\TypeElementType', $typeElement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeElement);
            $em->flush();

            return $this->redirectToRoute('typeElement_show', array('id' => $typeElement->getId()));
        }

        return $this->render('typeelement/new.html.twig', array(
            'typeElement' => $typeElement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeElement entity.
     *
     * @Route("/{id}", name="typeElement_show")
     * @Method("GET")
     */
    public function showAction(TypeElement $typeElement)
    {
        $deleteForm = $this->createDeleteForm($typeElement);

        return $this->render('typeelement/show.html.twig', array(
            'typeElement' => $typeElement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeElement entity.
     *
     * @Route("/{id}/edit", name="typeElement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypeElement $typeElement)
    {
        $deleteForm = $this->createDeleteForm($typeElement);
        $editForm = $this->createForm('AppBundle\Form\TypeElementType', $typeElement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typeElement_edit', array('id' => $typeElement->getId()));
        }

        return $this->render('typeelement/edit.html.twig', array(
            'typeElement' => $typeElement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeElement entity.
     *
     * @Route("/{id}", name="typeElement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypeElement $typeElement)
    {
        $form = $this->createDeleteForm($typeElement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeElement);
            $em->flush();
        }

        return $this->redirectToRoute('typeElement_index');
    }

    /**
     * Creates a form to delete a typeElement entity.
     *
     * @param TypeElement $typeElement The typeElement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeElement $typeElement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typeElement_delete', array('id' => $typeElement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
