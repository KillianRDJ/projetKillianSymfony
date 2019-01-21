<?php

namespace App\Form;

use App\Entity\Acteur;
use App\Entity\Genre;
use App\Entity\Realisateur;
use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('duree')
            ->add('date_sortie',DateType::Class, array(
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y')-100),
            ))

            ->add('notes')
            ->add('nationalite')
            ->add('description', TextareaType::class)
            ->add('limitation')
            ->add('url_ba')
            ->add('url_pochette')
            ->add('Genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('Acteur', EntityType::class, [
                'class' => Acteur::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('Realisateur', EntityType::class, [
                'class' => Realisateur::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
