<?php

namespace App\Form;

use App\Entity\LinkAsset;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkAsset1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url')
            ->add('idAsset')
            ->add('player')
            ->add('version')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LinkAsset::class,
        ]);
    }
}
