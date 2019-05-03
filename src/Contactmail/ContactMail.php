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

    public function __construct(\Swift_Mailer $mailer, Environment $renerer)
    {
        $this->mailer = $mailer;
        $this->render = $this->renderer;
    }

    public function notify(Contact $conact){
        $message = (new \Swift_Message('Contact YourSport'))
            ->setFrom('YourSport@protonmail.com')
            ->setTo('Yoursport@protonmail.com')
            ->setReplyTo($conact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig', [
                'contact' => $conact
            ]),'text/html');
        $this->mailer->send($message);
    }
}