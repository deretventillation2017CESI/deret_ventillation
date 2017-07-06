<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('statut');
        $builder->add('identifiantIGE');
        $builder->add('responsable');
        $builder->add('nbHeureTheoriqueSession');
        $builder->add('dateCreation', DateType::class, array(
            'widget' => 'choice',
            // this is actually the default format for single_text
            'format' => 'yyyy-MM-dd',
            // do not render as type="date", to avoid HTML5 date pickers
            'html5' => false,

            // add a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker'],));
        $builder->add('contrat');
        $builder->add('secteur');
        $builder->add('poste');
        $builder->add('batiment');
        $builder->add('typeHoraire');






    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}