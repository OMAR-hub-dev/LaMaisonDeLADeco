<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class,[
                        'label'=>'Votre prenom',
                        'attr'=>
                            ['placeholder'=>'. . . merci de saisir votre prenom']])
            ->add('lastName',TextType::class,[
                'label'=>'Votre nom',
                'attr'=>
                    ['placeholder'=>'. . . merci de saisir votre nom']])
            ->add('email',EmailType::class, [
                'label'=>'Votre email',
                'attr'=>
                    ['placeholder'=>'. . . merci de saisir votre email']])
            ->remove('roles')
            ->add('password',PasswordType::class,[
                'label'=>'Votre password',
                'attr'=>
                    ['placeholder'=>'. . . merci de saisir votre mot de passe']])
            ->add('password_confirm',PasswordType::class,[
                'label'=>'Confirmer votre password',
                'mapped'=>false,
                'attr'=>
                    ['placeholder'=>'. . . confirmer votre mot de passe']])
      
            ->add('submit',SubmitType::class,[
                'label'=>'s\'inscrire'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
