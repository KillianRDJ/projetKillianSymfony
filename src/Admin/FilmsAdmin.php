<?php

namespace App\Admin;

use App\Entity\Films;
use App\Entity\FilmsCategories;
use function PHPSTORM_META\type;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FilmsAdmin extends AbstractAdmin{

    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->with('Titre du film & Description', ['class' => 'col-md-9'])
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->end()
            ->with('Petit plus du film', ['class' => 'col-md-3'])
            ->add('genre', TextType::class)
            ->add('realisateur', TextType::class)
            ->add('time_film', TextType::class)
            ->add('date_sortie', DateType::class)
            ->add('acteurs', TextType::class)
            ->add('notes_allocine', TextType::class)
            ->add('notes', TextType::class)
            ->add('nationalite', TextType::class)
            ->add('limitation', IntegerType::class)
            ->end()

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('name')
            ->add('realisateur')
            ->add('genre')
            ->add('nationalite')
            ->add('notes')
        ;
    }
}

?>