<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ventilation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ventilation controller.
 *
 * @Route("ventilation")
 */
class VentilationController extends Controller
{
    /**
     * Lists all ventilation entities.
     *
     * @Route("/", name="ventilation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ventilations = $em->getRepository('AppBundle:Ventilation')->findAll();

        return $this->render('ventilation/index.html.twig', array(
            'ventilations' => $ventilations,
        ));
    }

    /**
     * Creates a new ventilation entity.
     *
     * @Route("/new", name="ventilation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ventilation = new Ventilation();
        $form = $this->createForm('AppBundle\Form\VentilationType', $ventilation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ventilation);
            $em->flush();

            return $this->redirectToRoute('ventilation_show', array('id' => $ventilation->getId()));
        }

        return $this->render('ventilation/new.html.twig', array(
            'ventilation' => $ventilation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ventilation entity.
     *
     * @Route("/{id}", name="ventilation_show")
     * @Method("GET")
     */
    public function showAction(Ventilation $ventilation)
    {
        $deleteForm = $this->createDeleteForm($ventilation);

        return $this->render('ventilation/show.html.twig', array(
            'ventilation' => $ventilation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ventilation entity.
     *
     * @Route("/{id}/edit", name="ventilation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ventilation $ventilation)
    {
        $deleteForm = $this->createDeleteForm($ventilation);
        $editForm = $this->createForm('AppBundle\Form\VentilationType', $ventilation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ventilation_edit', array('id' => $ventilation->getId()));
        }

        return $this->render('ventilation/edit.html.twig', array(
            'ventilation' => $ventilation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ventilation entity.
     *
     * @Route("/{id}", name="ventilation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ventilation $ventilation)
    {
        $form = $this->createDeleteForm($ventilation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ventilation);
            $em->flush();
        }

        return $this->redirectToRoute('ventilation_index');
    }

    /**
     * Creates a form to delete a ventilation entity.
     *
     * @param Ventilation $ventilation The ventilation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ventilation $ventilation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ventilation_delete', array('id' => $ventilation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
