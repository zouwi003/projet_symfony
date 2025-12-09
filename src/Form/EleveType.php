<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\Classe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('adresse')
            ->add('parentTelephone')
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => function(Classe $classe) {
                    return $classe->getNom() . ' - ' . $classe->getNiveau();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}

