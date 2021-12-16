<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\ResetPassword;
use App\Entity\User;
use App\Form\ResetPasswordType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    // private $entityManager;
    // public function __construct(EntityManagerInterface $entityManager)
    // {
    //     $this->entityManger = $entityManager;
    // }
    
    #[Route('/mot-de-passe-oublie', name: 'reset_password')]
    public function index(Request $request): Response
    {
        $entityManager= $this->getDoctrine()->getManager();

        if ($this->getUser()){
            return $this->redirectToRoute('home');
        }
        
        if( $request->get('email')){
            $user = $entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));
         
            if($user){
                // enregistrement en bdd de reset_password avec user, token, creatAt
                $reset_password = new ResetPassword();
                $reset_password->setUser($user);
                $reset_password->setToken(uniqid());
                $reset_password->setCreatedAt(new \DateTimeImmutable());
                $entityManager->persist($reset_password);
                $entityManager->flush();
                     
                //dd($reset_password);
                //Envoyer un mail de recuperation

                $url = $this->generateUrl('update_password', ['token'=>$reset_password->getToken()]);

                $text = "Bonjour ".$user->getFullNAme()."<br/> Vous avez demandé à réinitialiser votre mot de passe </br> </br>" ;
                $text .= "Merci de bien vouloir cliquer sur le lien suivant pour <a href='".$url."'>mettre à jour votre mot de passe </a>" ;
                $mail = new Mail();
                $mail->send( $user->getEmail(), $user->getFullName(), 'Réinitialiser votre mot de passe sur le site', $text);
    
                $this->addFlash('notice', 'un email de réinitialisiation a été envoyé .');

            }else{
                $this->addFlash('notice', 'Cette adresse email est inconnu');
                
             }
        }
       return $this->render('reset_password/index.html.twig');
    }



    #[Route('/modifier-mon-passe/{token}', name: 'update_password')]
    public function update(Request $request, $token, UserPasswordEncoderInterface $encoder): Response
    {
        $entityManager= $this->getDoctrine()->getManager();

        $reset_password = $entityManager->getRepository(ResetPassword::class)->findOneBy(['token'=>$token]);
       
        if(!$reset_password){
            return $this->redirectToRoute('reset_password');
        }

       $now = new DateTime();
       if ($now > $reset_password->getCreatedAt()->modify('+ 1 hour'))
        {
           $this->addFlash('notice', 'votre demande de changer le mot de passe a expiré. Merci de la renouveller');
            return $this->redirectToRoute('reset_password');
        }

        $form= $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $new_pwd = $form->get('new_password')->getData();
            
            $password= $encoder->encodePassword($reset_password->getUser(), $new_pwd);
            $reset_password->getUser()->setPassword($password);
           
            $entityManager->flush();

            $this->addFlash('notice', 'votre mot de passe a bien été mis à jour.');
            return $this->redirectToRoute('app_login');
            

        }
        
        return $this->render('reset_password/update.html.twig',[
            'form'=>$form->createView(),
        ]);

    }
}
