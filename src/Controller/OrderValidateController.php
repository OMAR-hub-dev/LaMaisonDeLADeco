<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderValidateController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager= $entityManager;
    }

    #[Route('/commande/merci', name: 'order_validate')]
    public function index(Cart $cart): Response
    {
        $cart->remove();
    //     $pay=  $this->entityManager->getRepository(Order::class)->findWithsuccess($this->getUser())[0];
    // if (!$pay->getIsPaid()){
    //     $pay->setIsPaid(1);
    //     $this->entityManager->flush();
    //}
    
        return $this->render('order_validate/index.html.twig');
    }
}
