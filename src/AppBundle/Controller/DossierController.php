<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dossier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Dossier controller.
 *
 * @Route("dossier")
 */
class DossierController extends Controller
{
    /**
     * Lists all dossier entities.
     *
     * @Route("/", name="dossier_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dossiers = $em->getRepository('AppBundle:Dossier')->findAll();

        return $this->render('dossier/index.html.twig', array(
            'dossiers' => $dossiers,
        ));
    }

    /**
     * Creates a new dossier entity.
     *
     * @Route("/new", name="dossier_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $dossier = new Dossier();
        $form = $this->createForm('AppBundle\Form\DossierType', $dossier);
        $form->handleRequest($request);
        $listeResponsable = $em->getRepository('AppBundle:Utilisateur')->findByResponsabe(1);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $responsable = $em->getRepository('AppBundle:Utilisateur')->findById($request->request->get('responsable'));
            $dossier->setResponsable($responsable);
            $em->persist($dossier);
            $em->flush();

            return $this->redirectToRoute('dossier_show', array('id' => $dossier->getId()));
        }

        return $this->render('dossier/new.html.twig', array(
            'dossier' => $dossier,
            'listeReponsable'=> $listeResponsable,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dossier entity.
     *
     * @Route("/{id}", name="dossier_show")
     * @Method("GET")
     */
    public function showAction(Dossier $dossier)
    {
        $deleteForm = $this->createDeleteForm($dossier);

        return $this->render('dossier/show.html.twig', array(
            'dossier' => $dossier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dossier entity.
     *
     * @Route("/{id}/edit", name="dossier_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Dossier $dossier)
    {
        $deleteForm = $this->createDeleteForm($dossier);
        $editForm = $this->createForm('AppBundle\Form\DossierType', $dossier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dossier_edit', array('id' => $dossier->getId()));
        }

        return $this->render('dossier/edit.html.twig', array(
            'dossier' => $dossier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dossier entity.
     *
     * @Route("/{id}", name="dossier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dossier $dossier)
    {
        $form = $this->createDeleteForm($dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dossier);
            $em->flush();
        }

        return $this->redirectToRoute('dossier_index');
    }

    /**
     * Creates a form to delete a dossier entity.
     *
     * @param Dossier $dossier The dossier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dossier $dossier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dossier_delete', array('id' => $dossier->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
