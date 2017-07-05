<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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
        $builder->add('dateCreation');
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