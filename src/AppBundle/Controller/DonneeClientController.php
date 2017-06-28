<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DonneeClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Donneeclient controller.
 *
 * @Route("donneeclient")
 */
class DonneeClientController extends Controller
{
    /**
     * Lists all donneeClient entities.
     *
     * @Route("/", name="donneeclient_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $donneeClients = $em->getRepository('AppBundle:DonneeClient')->findAll();

        return $this->render('donneeclient/index.html.twig', array(
            'donneeClients' => $donneeClients,
        ));
    }

    /**
     * Creates a new donneeClient entity.
     *
     * @Route("/new", name="donneeclient_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $donneeClient = new Donneeclient();
        $form = $this->createForm('AppBundle\Form\DonneeClientType', $donneeClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($donneeClient);
            $em->flush();

            return $this->redirectToRoute('donneeclient_show', array('id' => $donneeClient->getId()));
        }

        return $this->render('donneeclient/new.html.twig', array(
            'donneeClient' => $donneeClient,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a donneeClient entity.
     *
     * @Route("/{id}", name="donneeclient_show")
     * @Method("GET")
     */
    public function showAction(DonneeClient $donneeClient)
    {
        $deleteForm = $this->createDeleteForm($donneeClient);

        return $this->render('donneeclient/show.html.twig', array(
            'donneeClient' => $donneeClient,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing donneeClient entity.
     *
     * @Route("/{id}/edit", name="donneeclient_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DonneeClient $donneeClient)
    {
        $deleteForm = $this->createDeleteForm($donneeClient);
        $editForm = $this->createForm('AppBundle\Form\DonneeClientType', $donneeClient);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('donneeclient_edit', array('id' => $donneeClient->getId()));
        }

        return $this->render('donneeclient/edit.html.twig', array(
            'donneeClient' => $donneeClient,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a donneeClient entity.
     *
     * @Route("/{id}", name="donneeclient_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DonneeClient $donneeClient)
    {
        $form = $this->createDeleteForm($donneeClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($donneeClient);
            $em->flush();
        }

        return $this->redirectToRoute('donneeclient_index');
    }

    /**
     * Creates a form to delete a donneeClient entity.
     *
     * @param DonneeClient $donneeClient The donneeClient entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DonneeClient $donneeClient)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('donneeclient_delete', array('id' => $donneeClient->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
