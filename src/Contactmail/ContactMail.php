<?php


namespace App\Contactmail;

use App\Entity\Contact;
use Twig\Environment;

class ContactMail
{
    /**
     * ContactMail constructor.
     * @param \Swift_Mailer $mailer
     * @param Environment $renerer
     */

    /**
     * @var \Swift_Mailer
     */

    private $mailer;

    /**
     * @var Environment
     */

    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact){
        $message = (new \Swift_Message('Contact YourSport'))
            ->setFrom('yoursport78190@gmail.com')
            ->setTo('yoursport78190@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig', [
                'contact' => $contact
            ]),'text/html');
        $this->mailer->send($message);
    }
}