<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateTimeField::new('createdAt', 'passée le'),
            TextField:: new ('user.getFullName', 'Utilisateurs'),
            MoneyField:: new ('total')->setCurrency('EUR'),
            TextField:: new ('transportName', 'transporteur'),
            MoneyField:: new ('transportPrice', 'frais de port')->setCurrency('EUR'),
            ChoiceField::new('state', 'statut')->setChoices([
                'Non payée' =>0,
                'Payé'      =>1,
                'Prepartion en cours' =>2,
                'Livraison'     =>3,
            ]),
            ArrayField::new('orderDetails','Produits achetés')
         
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id'=>'DESC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add('index','detail');
    }
    
}
