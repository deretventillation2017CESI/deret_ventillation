<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Formulaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Formulaire controller.
 *
 * @Route("formulaire")
 */
class FormulaireController extends Controller
{
    /**
     * Lists all formulaire entities.
     *
     * @Route("/", name="formulaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formulaires = $em->getRepository('AppBundle:Formulaire')->findAll();

        return $this->render('formulaire/index.html.twig', array(
            'formulaires' => $formulaires,
        ));
    }

    /**
     * Lists all formulaire entities.
     *
     * @Route("/static", name="formulaire_static")
     * @Method("GET")
     */
    public function staticAction()
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()->add('activites', EntityType::class, array(
            // query choices from this entity
            'class' => 'AppBundle:Formulaire',

            // use the User.username property as the visible option string
            'choice_label' => 'libelle',))->add('quantite', TextType::class)->add('temps', TextType::class)->add('commentaire', TextareaType::class)
            ->add('typeActivite', EntityType::class, array(
                // query choices from this entity
                'class' => 'AppBundle:TypeActivite',

                // use the User.username property as the visible option string
                'choice_label' => 'libelle',))
            ->getForm();

        return $this->render('formulaire/static.html.twig', array('form' => $form->createView()));
    }


    /**
     * Creates a new formulaire entity.
     *
     * @Route("/new", name="formulaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formulaire = new Formulaire();
        $form = $this->createForm('AppBundle\Form\FormulaireType', $formulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formulaire);
            $em->flush();

            return $this->redirectToRoute('formulaire_show', array('id' => $formulaire->getId()));
        }

        return $this->render('formulaire/new.html.twig', array(
            'formulaire' => $formulaire,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a formulaire entity.
     *
     * @Route("/{id}", name="formulaire_show")
     * @Method("GET")
     */
    public function showAction(Formulaire $formulaire)
    {
        $deleteForm = $this->createDeleteForm($formulaire);

        return $this->render('formulaire/show.html.twig', array(
            'formulaire' => $formulaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a formulaire entity.
     *
     * @Route("/{id}/afficher", name="formulaire_afficher")
     * @Method("GET")
     */
    public function afficherAction(Formulaire $formulaire)
    {
        $deleteForm = $this->createDeleteForm($formulaire);

        return $this->render('formulaire/afficher.html.twig', array(
            'formulaire' => $formulaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     *
     * @Route("/{id}/remplir", name="formulaire_remplir")
     * @Method({"GET","POST"})
     */
    public function remplirAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if($request->isXmlHttpRequest()) // pour vérifier la présence d'une requete Ajax
        {
            $id = $request->request->get('id');
            if ($id != null)
            {
                $repository = $em->getRepository('AppBundle:DonneeClientElement');
                $data = $repository->findBy(array('interaction'=>$id));
                return new JsonResponse($data);
            }
        }
        return new Response("Nonnn ....");
    }

    /**
     *
     * @Route ("/{id}/addElement/", name="formulaire_addElement")
     * @Method({"GET","POST"})
     */
    public function addElementAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $repFormulaire = $em->getRepository('AppBundle:Formulaire');
        $formulaire = $repFormulaire->find($id);
        $repElement = $em->getRepository('AppBundle:Element');
        $elements = $repElement->findAll();

        if($request->getMethod() == 'POST'){
            $element = $repElement->find($_POST['element']);
            $formulaire->addListeElement($element);
            $em->persist($formulaire);
            $em->flush();
        }

        return $this->render('formulaire/addElement.html.twig', array(
            'formulaire' => $formulaire,
            'elements' => $elements
        ));
    }

    /**
     * Displays a form to edit an existing formulaire entity.
     *
     * @Route("/{id}/edit", name="formulaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Formulaire $formulaire)
    {
        $deleteForm = $this->createDeleteForm($formulaire);
        $editForm = $this->createForm('AppBundle\Form\FormulaireType', $formulaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formulaire_edit', array('id' => $formulaire->getId()));
        }

        return $this->render('formulaire/edit.html.twig', array(
            'formulaire' => $formulaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a formulaire entity.
     *
     * @Route("/{id}", name="formulaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Formulaire $formulaire)
    {
        $form = $this->createDeleteForm($formulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formulaire);
            $em->flush();
        }

        return $this->redirectToRoute('formulaire_index');
    }

    /**
     * Creates a form to delete a formulaire entity.
     *
     * @param Formulaire $formulaire The formulaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Formulaire $formulaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formulaire_delete', array('id' => $formulaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
