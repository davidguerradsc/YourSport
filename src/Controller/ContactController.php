<?php


namespace App\Controller;


use App\Contactmail\ContactMail;
use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * Création du formulaire de contact
     * @Route("/contact.html", name="contact_contact")
     */

    public function contact(Request $request, ContactMail $ContactMail)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $ContactMail->notify($contact);
            $this->addFlash('notice', 'Votre mail a bien été envoyé, nous vous répondrons dés que possible.');
        }

        return $this->render("contact/contact.html.twig", [
           'form' => $form->createView()
        ]);
    }


}