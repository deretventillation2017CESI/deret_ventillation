<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypeActivite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typeactivite controller.
 *
 * @Route("typeactivite")
 */
class TypeActiviteController extends Controller
{
    /**
     * Lists all typeActivite entities.
     *
     * @Route("/", name="typeactivite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeActivites = $em->getRepository('AppBundle:TypeActivite')->findAll();

        return $this->render('typeactivite/index.html.twig', array(
            'typeActivites' => $typeActivites,
        ));
    }

    /**
     * Creates a new typeActivite entity.
     *
     * @Route("/new", name="typeactivite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeActivite = new Typeactivite();
        $form = $this->createForm('AppBundle\Form\TypeActiviteType', $typeActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeActivite);
            $em->flush();

            return $this->redirectToRoute('typeactivite_show', array('id' => $typeActivite->getId()));
        }

        return $this->render('typeactivite/new.html.twig', array(
            'typeActivite' => $typeActivite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeActivite entity.
     *
     * @Route("/{id}", name="typeactivite_show")
     * @Method("GET")
     */
    public function showAction(TypeActivite $typeActivite)
    {
        $deleteForm = $this->createDeleteForm($typeActivite);

        return $this->render('typeactivite/show.html.twig', array(
            'typeActivite' => $typeActivite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeActivite entity.
     *
     * @Route("/{id}/edit", name="typeactivite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypeActivite $typeActivite)
    {
        $deleteForm = $this->createDeleteForm($typeActivite);
        $editForm = $this->createForm('AppBundle\Form\TypeActiviteType', $typeActivite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typeactivite_edit', array('id' => $typeActivite->getId()));
        }

        return $this->render('typeactivite/edit.html.twig', array(
            'typeActivite' => $typeActivite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeActivite entity.
     *
     * @Route("/{id}", name="typeactivite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypeActivite $typeActivite)
    {
        $form = $this->createDeleteForm($typeActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeActivite);
            $em->flush();
        }

        return $this->redirectToRoute('typeactivite_index');
    }

    /**
     * Creates a form to delete a typeActivite entity.
     *
     * @param TypeActivite $typeActivite The typeActivite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeActivite $typeActivite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typeactivite_delete', array('id' => $typeActivite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
