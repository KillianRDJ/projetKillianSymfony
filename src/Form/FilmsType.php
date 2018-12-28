<?php

namespace App\Form;

use App\Entity\Acteur;
use App\Entity\Films;
use App\Entity\Genre;
use App\Entity\Realisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('time_film')
            ->add('date_sortie',DateType::Class, array(
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y')-100),
            ))

            ->add('notes_allocine')
            ->add('notes')
            ->add('nationalite')
            ->add('description', TextareaType::class)
            ->add('limitation')
            ->add('url_ba')
            ->add('url_pochette')
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('acteurs', EntityType::class, [
                'class' => Acteur::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('realisateurs', EntityType::class, [
                'class' => Realisateur::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Films::class,
        ]);
    }
}
