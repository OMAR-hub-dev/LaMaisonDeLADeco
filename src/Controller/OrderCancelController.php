<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Order;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderCancelController extends AbstractController
{
    #[Route('/commande/erreur/{stripeSession}', name: 'order_cancel')]
    public function index($stripeSession): Response
    {
        $entityManager= $this->getDoctrine()->getManager();
        // $cart->remove();
        $pay=  $entityManager->getRepository(Order::class)->findOneByStripeSession(['stripeSession'=>$stripeSession]);
       
        if (!$pay || $pay->getUser() != $this->getUser()){
            return $this->redirectToRoute('home');
        }
        $email = new Mail();
        $name= "e Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles,"; 
        //send($to-email, $to_name, $subject, $name=>la variable qu'on a declaré au niveau mailJet,)
        $email->send($pay->getUser()->getEmail(),$pay->getUser()->getFirstName(), 'bienvenue ', $name );
    
        return $this->render('order/cancel.html.twig',[
            'payé'=>$pay
        ]);
    }
}
