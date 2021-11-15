<?php

namespace App\Controller;

use Stripe\Stripe;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager= $entityManager;
    }
     
    #[Route('/create-checkout-session/{reference}', name: 'stripe')]
    public function checkout( $reference): Response
    {
        //    $entityManager= $this->getDoctrine()->getManager();

        $pay=  $this->entityManager->getRepository(Order::class)->findOneByReference($reference);
       
       

        Stripe::setApiKey('sk_test_51JsG1wCEfInZTtcA0NO7R4XlmHyZD0aiQ2c5ea8DXUyXuTRcD0VVBSgf9aDwWbtRzmrTzOw7nhDne0rWltZl1uuY00jPuN5FkU ');
        $YOUR_DOMAIN = 'https://127.0.0.1:8000';
        $produit_for_stripe = [];
        
        foreach ($pay->getOrderDetails()->getValues() as $product) {
            $product_object =  $this->entityManager->getRepository(Product::class)->findOneByName($product->getProduct());
        
            $produit_for_stripe[] = [
                'price_data' =>[
                'currency'=> 'EUR',
                 'unit_amount'=> $product->getPrice(),
                 
                 'product_data'=>[
                    'name'=>$product->getProduct(),
                     'images'=>[$YOUR_DOMAIN."/uploads/".$product_object->getIllustration()]
                 ]
                ],
                'quantity' => $product->getQuantity(),
            ];
            
        }

        $produit_for_stripe[] = [
            'price_data' =>[
            'currency'=> 'EUR',
             'unit_amount'=> $pay->getTransportPrice(),
             
             'product_data'=>[
                'name'=>$pay->getTransportName(),
                 'images'=>[$YOUR_DOMAIN]
             ]
            ],
            'quantity' =>1,
        ];
 
        
        
        $session = Session::create([
            'customer_email'=>$this->getUser()->getEmail(),
            'line_items' => [
                $produit_for_stripe
            ],
            'payment_method_types' => [
                'card',
            ],
            'mode' => 'payment',
            'success_url' =>$YOUR_DOMAIN . '/commande/merci/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . '/commande/erreur/{CHECKOUT_SESSION_ID}',

        ]);
        
      $pay->setStripeSession($session->id);
  
      $this->entityManager->flush();
        return $this->redirect($session->url,303);
    }      

 }




    // #[Route('/checkout', name: 'checkout')]
    // public function paymentIntent(Cart $cart): Response
    // {
    //     \Stripe\Stripe::setApiKey($this->privatekey);
           
    //     // $produit_for_stripe = [];
    //     // $YOUR_DOMAIN = 'https://127.0.0.1:8000';
 
    //     // foreach ($cart->getFull() as $product) {
    //     //     $produit_for_stripe[] = [
    //     //         'price_data' =>[
    //     //         'currency'=> 'EUR',
    //     //          'unit_amount'=> $product['product']->getPrice(),
                 
    //     //          'product_data'=>[
    //     //             'name'=>$product['product']->getName(),
    //     //              'images'=>[$YOUR_DOMAIN."/uploads/".$product['product']->getIllustration()]
    //     //          ]
    //     //         ],
    //     //         'quantity' => $product['quantity'],
    //     //     ];
    //     // }

    //     return \Stripe\PaymentIntent::create([
    //         'payment_method_types' => ['card'],
    //         'amount'=> $cart->getFull()->getPrice(),
    //         'currency'=> 'EUR',
            
    //     //     'line_items'           => [
    //     //         [
    //     //             $produit_for_stripe
    //     //         ]
    //     //     ],
    //     //     'mode'                 => 'payment',
    //     //     'success_url'          => $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
    //     //     'cancel_url'           => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
    //     ]);
    // }
    // public function paiement(
    //     $amount,
    //     $currency,
    //     $description,
    //      array $stripeParameter)
    // {
    //     \Stripe\Stripe::setApiKey($this->privatekey);
    //     $payment_intent = null;
    //     if (isset ($stripeParameter['stripIntentId'])){
    //         $payment_intent = \Stripe\PaymentIntent::retrieve($stripeParameter['stripIntentId']);
    //     }
    //     if($stripeParameter['stripIntentId'] === 'succeeded')
    //     {
             
    //     }else{
    //         $payment_intent->cancel();
    //     }
    //     return $payment_intent;
    // }

    // public function Stripe(array $stripeParameter, Cart $cart)
    // {
    //     return $this->paiement();
    // }