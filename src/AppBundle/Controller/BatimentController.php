<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Batiment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Batiment controller.
 *
 * @Route("batiment")
 */
class BatimentController extends Controller
{
    /**
     * Lists all batiment entities.
     *
     * @Route("/", name="batiment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $batiments = $em->getRepository('AppBundle:Batiment')->findAll();

        return $this->render('batiment/index.html.twig', array(
            'batiments' => $batiments,
        ));
    }

    /**
     * Creates a new batiment entity.
     *
     * @Route("/new", name="batiment_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $batiment = new Batiment();
        $form = $this->createForm('AppBundle\Form\BatimentType', $batiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($batiment);
            $em->flush();

            return $this->redirectToRoute('batiment_show', array('id' => $batiment->getId()));
        }

        return $this->render('batiment/new.html.twig', array(
            'batiment' => $batiment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a batiment entity.
     *
     * @Route("/{id}", name="batiment_show")
     * @Method("GET")
     */
    public function showAction(Batiment $batiment)
    {
        $deleteForm = $this->createDeleteForm($batiment);

        return $this->render('batiment/show.html.twig', array(
            'batiment' => $batiment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing batiment entity.
     *
     * @Route("/{id}/edit", name="batiment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Batiment $batiment)
    {
        $deleteForm = $this->createDeleteForm($batiment);
        $editForm = $this->createForm('AppBundle\Form\BatimentType', $batiment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('batiment_edit', array('id' => $batiment->getId()));
        }

        return $this->render('batiment/edit.html.twig', array(
            'batiment' => $batiment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a batiment entity.
     *
     * @Route("/{id}", name="batiment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Batiment $batiment)
    {
        $form = $this->createDeleteForm($batiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($batiment);
            $em->flush();
        }

        return $this->redirectToRoute('batiment_index');
    }

    /**
     * Creates a form to delete a batiment entity.
     *
     * @param Batiment $batiment The batiment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Batiment $batiment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('batiment_delete', array('id' => $batiment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
