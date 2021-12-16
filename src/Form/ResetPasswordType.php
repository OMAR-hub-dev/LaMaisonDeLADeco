<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('new_password', RepeatedType::class, [
            'type'=>PasswordType::class, 
            // 'mapped'=>false,
            'invalid_message'=>'le mot de passe et la confiramation doivent être identique',
            'label'=>'Votre password',
            'required'=>true,
            'first_options'=>[
                'label'=>'Mon nouveau mot de passe',
                'attr'=>
                ['placeholder'=>'. . . merci de saisir votre nouveau mot de passe',
                'class'     =>'form-contact  ']
                ],
            'second_options'=>[
                'label'=>'confirmer votre mot de passe',
                'attr'=>
                ['placeholder'=>'. . . merci de confirmer votre nouveau mot de passe',
                'class'     =>'form-contact  ']
                ],
            'constraints'=>[
                new NotBlank([
                'message' => 'veuillez entrer votre mot de passe',
                ]),
                new Length([
                    'min' => 4,
                    'minMessage' => 'votre mot de passe doit contenir au minimum {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 30,
                ]),
            ]
        ])
        ->add('submit',SubmitType::class,[
            'label'=>'Mettre à jour mon de passe',
            'attr'=>[
                'class'=>'btn btn-block btn-info'
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
