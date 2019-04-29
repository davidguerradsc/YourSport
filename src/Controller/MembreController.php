<?php


namespace App\Controller;

use App\Entity\Membre;
use App\Form\ConnexionFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\httpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class MembreController extends AbstractController
{
    /**
     * @Route("/connexion.html", name="membre_connexion")
     */
    public function connexion(AuthenticationUtils $authenticationUtils)
    {
        #récuperation du Formulaire de connexion
        $form = $this->createForm(ConnexionFormType::class, [
            'email' => $authenticationUtils->getLastUsername()
        ]);

        #Affichage du formulaire dans la vue
        return $this->render('membre/connexion.html.twig', [
            'form' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }
}