<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class,[
                'label'=>'votre prenom',
                'attr'=>[
                    'placeholder'=>'... ',
                    'class'     =>'form-contact  ',
                ]
            ])
            ->add('nom', TextType::class,[
                'label'=>'votre nom',
                'attr'=>[
                    'placeholder'=>'... ',
                    'class'     =>'form-contact  ',
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=>'votre email',
                'attr'=>[
                    'placeholder'=>'... ',
                    'class'     =>'form-contact  ',
                ]
            ])
            ->add('content', CKEditorType::class ,[
                'label'=>'votre message',
                'attr'=>[
                    'placeholder'=>'... ',
                    'class'     =>'form-contact  ',
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label'=>'Envoyer',
                'attr'  =>[
                    'placeholder'=>'... ',
                    'class'     =>'  ',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
