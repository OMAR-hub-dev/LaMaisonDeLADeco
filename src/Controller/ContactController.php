<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('notice', 'Merci de nous avoir contaté. Notre équipe va vous repondre dans les meilleurs délais.');
            


            $text="demande de contact de  la part de : ".$form->get("nom")->getData()."</br> son adress mail est :".$form->get('email')->getData()."</br>";
            $text.= " le contenu de sa  demande est : ".$form->get('content')->getData();
            $mail = new Mail();
            $mail->send('petit.monstre@YOPmail.com', $form->get("nom")->getData(),'nouvelle demande de contact',$text);

            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig',[
            'form'=>$form->createView(),
        ]);
    }
}