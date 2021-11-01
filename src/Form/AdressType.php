<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'     =>'quel nom souhaitez-vous donnera votre adresse',
                'attr'      =>[
                    'placeholder' =>'Nommez votre adresse'
                ]
            ])
            ->add('firstName',TextType::class,[
                'label'     =>'Prenom',
                'attr'      =>[
                    'placeholder' =>'entrez votre prenom'
                ]
            ])
            ->add('lastName',TextType::class,[
                'label'     =>'Nom',
                'attr'      =>[
                    'placeholder' =>'entrez votre nom'
                ]
            ])
            ->add('company',TextType::class,[
                'label'     =>'Société',
                'required'  =>false,
                'attr'      =>[
                    'placeholder' =>'(... votre société)'
                ]
            ])
            ->add('address',TextType::class,[
                'label'     =>'votre adresse',
                'attr'      =>[
                    'placeholder' =>'Entrez votre adresse'
                ]
            ])
            ->add('postal',TextType::class,[
                'label'     =>'code postale ',
                'attr'      =>[
                    'placeholder' =>'Entrez votre code postale'
                ]
            ])
            ->add('city',TextType::class,[
                'label'     =>'Ville',
                'attr'      =>[
                    'placeholder' =>'Entrez Votre ville'
                ]
            ])
            ->add('contry',CountryType::class,[
                'label'     =>'Pays',
                'attr'      =>[
                    'placeholder' =>'Entrez Votre pays'
                ]
            ])
            ->add('phone',TelType::class,[
                'label'     =>'téléphone',
                'attr'      =>[
                    'placeholder' =>'Entrez votre numéro de téléphone'
                ]
            ])
            ->add('submit',SubmitType::class,[
                'label'     =>'Valider',
                'attr'      =>[
                    'class'=>'btn btn-block btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
