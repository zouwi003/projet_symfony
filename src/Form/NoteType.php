<?php

namespace App\Form;

use App\Entity\Note;
use App\Entity\Eleve;
use App\Entity\Matiere;
use App\Entity\Enseignant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            ->add('eleve', EntityType::class, [
                'class' => Eleve::class,
                'choice_label' => function(Eleve $eleve) {
                    return $eleve->getNom() . ' ' . $eleve->getPrenom();
                },
            ])
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'nom',
            ])
            ->add('enseignant', EntityType::class, [
                'class' => Enseignant::class,
                'choice_label' => function(Enseignant $enseignant) {
                    return $enseignant->getNom() . ' ' . $enseignant->getPrenom();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}

