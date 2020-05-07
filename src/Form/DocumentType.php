<?php

namespace App\Form;

use App\Entity\Document;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('documentFile', VichFileType::class, [
                'required' => false,
                'download_uri' => true,
                'delete_label' => 'supprimer',
                'label' => 'Documents',
                'download_link' => false,
                'allow_delete' => false,
            ])
            ->add('name', TextType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
