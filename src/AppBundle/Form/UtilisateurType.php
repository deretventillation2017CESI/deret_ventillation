<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('prenom')
            ->add('statut')
            ->add('identifiantIGE')
            ->add('responsable')
            ->add('nbHeureTheoriqueSession')
            ->add('dateCreation', DateType::class, array(
                'widget' => 'choice',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],))
            ->add('contrat')
            ->add('typeHoraire')
            ->add('secteur')
            ->add('batiment')
            ->add('poste');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Utilisateur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_utilisateur';
    }


}
