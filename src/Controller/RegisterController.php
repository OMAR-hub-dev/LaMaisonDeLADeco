<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Classe\Mail;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManger = $entityManager;
    }
    #[Route('/inscription', name: 'register')]
    public function index(Request $request, UserPasswordEncoderInterface $encoder) : Response
    {
        $user= new User();
        $notification = null;
        $form =$this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $entityManager= $this->getDoctrine()->getManager();
            $exist_mail = $entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());
           
            if(!$exist_mail){
                $password= $encoder->encodePassword($user, $user->getPassword());
                $user->setRoles(["ROLE_USER"]);
                $user->setPassword($password);
                $this->entityManger->persist($user);
                $this->entityManger->flush();

                $notification= 'votre inscription s\'est bien, déroulée ';
                
                $email = new Mail();
                $name= "e Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles,"; 
                //send($to-email, $to_name, $subject, $name=>la variable qu'on a declaré au niveau mailJet,)
                $email->send($user->getEmail(),$user->getFirstName(), 'bienvenue ', $name );
            }else{
                $notification= 'cet  adresse mail <<'.$user->getEmail().'>> existe deja';  
                
            }
           
          
        }
        
        

        return $this->render('register/index.html.twig', [
            'form'=> $form->createView(),
            'notification'=>$notification,
        ]);
    }
}
