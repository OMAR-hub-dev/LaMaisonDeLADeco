<?php

namespace App\Form;

use App\Entity\Adress;
use App\Entity\Transport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $builder
            ->add('adresses', EntityType::class,[
                'label'     => false,
                'required'  => true,
                'class'     =>Adress::class,
                'choices'   =>$user->getAdresses(),
                'multiple'  =>false,
                'expanded'  =>true,

            ])
            ->add('transporteurs', EntityType::class,[
                'label'     => 'Choisissez votre mode de livraison ',
                'required'  => true,
                'class'     =>Transport::class,
                // 'choices'   =>$user->getName(),
                'multiple'  =>false,
                'expanded'  =>true,

            ])
            ->add('submit', SubmitType:: class, [
                'label'=>'valider ma commande',
                'attr'  =>[
                    'class'=>'btn '
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user'=>array()
        ]);
    }
}
