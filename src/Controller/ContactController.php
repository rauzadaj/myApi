<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
class ContactController extends AbstractController
{
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request): Response
    {
        $defaultData = ['message' => 'Tapez votre message ici'];
        $form = $this->createFormBuilder($defaultData)
            ->add('firstname', TextType::class, [
                'attr' => ['class'=>'form-control', 'id' => 'inputEmail4', 'placeholder' => 'Firstname']
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['class'=>'form-control', 'id' => 'inputPassword4', 'placeholder' => 'Lastname']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class'=>'form-control', 'id' => 'inputAddress', 'placeholder' => 'E-mail']
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['class'=>'form-control', 'id' => 'inputAddress2', 'placeholder' => 'Votre message...']
            ])
            ->add('send', SubmitType::class, [
                'attr' => ['class'=>'btn btn-lg btn-primary btn-block', 'id' => '']
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $this->sendMail($data);
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/email")
     */
    public function sendMail($data)
    {

        $email = (new TemplatedEmail())
            ->from($data['email'])
            ->to('jrauzada@miaoow.me')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            ->priority(Email::PRIORITY_NORMAL)
            ->subject('Formulaire de contact SchooLand')
            ->text($data['message'])
            ->htmlTemplate('emails/contact.html.twig')
            ->context(['data' => $data]);
        try {
            $this->mailer->send($email);
        } catch (TransportException $exception) {
            echo $exception->getMessage().PHP_EOL;
        }
    }
}
