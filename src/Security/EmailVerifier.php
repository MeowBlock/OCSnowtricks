<?php

namespace App\Security;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class EmailVerifier
{
    public function __construct(
        private VerifyEmailHelperInterface $verifyEmailHelper,
        private MailerInterface $mailer,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function sendEmailConfirmation(string $verifyEmailRouteName, UserInterface $user, TemplatedEmail $email): void
    {
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            $verifyEmailRouteName,
            $user->getId(),
            $user->getEmail()
        );

        $context = $email->getContext();
        $context['signedUrl'] = $signatureComponents->getSignedUrl();
        $context['expiresAtMessageKey'] = $signatureComponents->getExpirationMessageKey();
        $context['expiresAtMessageData'] = $signatureComponents->getExpirationMessageData();

        $email->context($context);

        $transport = Transport::fromDsn('smtp://bc15b916566818:5ad246492f91b6@sandbox.smtp.mailtrap.io:2525');
        // Create a Mailer object 
        $mailer = new Mailer($transport); 
        // Create an Email object 
        $email = (new Email());
        // Set the "From address" 
        $email->from('site@meowblock.net');
        // Set the "From address" 
        $email->to($user->getEmail());
        // Set a "subject" 
        $email->subject('Demande de contact depuis le site Snowtricks');
        // Set HTML "Body" 
        $html = '<p>
        Please confirm your email address by clicking the following link: <br><br>
        <a href="'. $context['signedUrl'].'">Confirm my Email</a>.
        This link will expire in 15 minutes.
    </p>';

        $email->html($html);
        // Send the message 
        $mailer->send($email);
        
        $this->mailer->send($email);
    }

    /**
     * @throws VerifyEmailExceptionInterface
     */
    public function handleEmailConfirmation(Request $request, UserInterface $user): void
    {
        $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());

        $user->setIsVerified(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
