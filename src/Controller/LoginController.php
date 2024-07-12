<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
       // get the login error if there is one
       $error = $authenticationUtils->getLastAuthenticationError();
       // last username entered by the user
       $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
           'controller_name' => 'LoginController',
           'last_username' => $lastUsername,
           'error'         => $error,
        ]);
    }
    #[Route('/forgot-password', name: 'app_forgot')]
    public function forgot_password(AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager): Response
    {

        $request = Request::createFromGlobals();
        $userEmail = $request->request->get('email', '');
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $userEmail]);


        if($userEmail) {

            $transport = Transport::fromDsn('smtp://bc15b916566818:5ad246492f91b6@sandbox.smtp.mailtrap.io:2525');
            // Create a Mailer object 
            $mailer = new Mailer($transport); 
            // Create an Email object 
            $email = (new Email());
            // Set the "From address" 
            $email->from('site@meowblock.net');
            // Set the "From address" 
            $email->to($userEmail);
            // Set a "subject" 
            $email->subject('Nouveau mot de passe Snowtricks');
            // Set HTML "Body" 
            $plaintextPassword = bin2hex(random_bytes(5));
            $html = '<p>
            cliquez sur ce lien pour réinitialiser votre mot de passe '.$_ENV['SITE_URL'].'user/'.$user->getId().'/new_pw?pw='.$plaintextPassword.'.
            </p>';

            $email->html($html);
            // Send the message 
            $mailer->send($email);


            $hashedPassword = $this->hasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
            }

       // get the login error if there is one
       $error = $authenticationUtils->getLastAuthenticationError();
       // last username entered by the user
       $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/forgot.html.twig', [
           'controller_name' => 'LoginController',
           'last_username' => $lastUsername,
           'error'         => $error,
        ]);
    }
}
