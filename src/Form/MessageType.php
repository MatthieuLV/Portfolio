<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('senderName', TextType::class, [
                'label' => 'Nom :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre nom'
                    ]),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Votre nom ne doit pas dépasser {{ limit }} caractères.'
                    ])
                ],
            ])
            ->add('senderEmail', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('senderPhone', TextType::class, [
                'label' => 'Téléphone :',
                'constraints' => [
                    new Length([
                    'max' => 11,
                    'maxMessage' => 'Votre numéro de telephone ne doit pas dépasser {{ limit }} caractères.'
                    ])
                ],    
            ])
            ->add('subject', TextType::class, [
                'label' => "Objet :",
                'constraints' => [
                    new Length([
                    'max' => 80,
                    'maxMessage' => "L'objet de votre message ne doit pas dépasser {{ limit }} caractères."
                    ])
                ],  
            ])
            ->add('body', TextareaType::class, [
                'label' => 'Message :',
                'constraints' => [
                    new Length([
                    'max' => 500,
                    'maxMessage' => 'Votre message ne doit pas dépasser {{ limit }} caractères.'
                    ])
                ],  
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
