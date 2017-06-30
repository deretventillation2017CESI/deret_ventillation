<?php

namespace AppBundle\Form;

use AppBundle\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
class VentilationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tempsPasse');//->add('validation');
        $builder->add('produit', EntityType::class, array('class'=> 'AppBundle:Produit', 'choice_label' => 'libelle'));
        $builder->add('quantite', TextType::class);
        $builder->add('commentaire', TextareaType::class);
        $builder->add('completed', HiddenType::class, array (
            'mapped'    => false
        ));
        $builder->add('formulaire', HiddenType::class, array (
            'mapped'    => false
        ));
        /*$builder->add('ventilationFormulaire', VentilationFormulaireType::class,array (
            'label'    => false,
            'by_reference' =>false
        ));*/
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ventilation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ventilation';
    }
}
