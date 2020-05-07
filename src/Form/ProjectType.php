<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Skill;
use App\Entity\Photo;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DocumentType;


class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom du projet'
            ])
            ->add('description',TextareaType::class, [
                'label' => 'Description du projet :'
            ])
            ->add('context',TextareaType::class, [
                'label' => 'Contexte :'
            ])
            ->add('period',TextType::class, [
                'label' => 'Periode :'
            ])
            ->add('results',TextareaType::class, [
                'label' => 'Bilan :'
            ])
            ->add('skills', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('isActive')
            ->add('photos', CollectionType::class,
            [
                'entry_type' => PhotoType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'label' => false,
                'prototype' => true,
                'allow_delete' => true,
                'by_reference' => false,    
            ])
            ->add('documents', CollectionType::class,
            [
                'entry_type' => DocumentType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'label' => false,
                'prototype' => true,
                'allow_delete' => true,
                'by_reference' => false,    
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Ajouter le projet"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
