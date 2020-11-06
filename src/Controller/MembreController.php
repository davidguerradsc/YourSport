<?php


namespace App\Controller;


use App\Entity\Evenement;
use App\Entity\Membre;
use App\Form\ConnexionFormType;
use App\Form\MembreFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MembreController extends AbstractController
{

    /**
     * Page d'incription d'un nouveau membre
     * @Route("/inscription.html", name="membre_inscription")
     */

    public function inscription(Request $request, UserPasswordEncoderInterface $encoder)
    {
        #Création d'un membre
        $membre = new Membre();
        $membre->setRoles(['ROLE_USER']);

        # Création du formulaire "MembreFormType" + Vérification de la soumission du formulaire
        $form = $this->createForm(MembreFormType::class, $membre)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            #Encodage du mot de passe avant l'envoi en BDD
            $membre->setPassword(
                $encoder->encodePassword($membre, $membre->getPassword())
            );

            #Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            # Notification "tout est OK"
            $this->addFlash('notice',
                'Bravo, votre compte à bien été créé. Vous pouvez vous connecter !');

            # Redirection
            return $this->redirectToRoute('membre_connexion');

        }
        # Affichage du formulaire dans la vue
        return $this->render("membre/inscription.html.twig", [
            'form' => $form->createView()
        ]);


    }

    /**
     * Création du formulaire de connexion
     * @Route("/connexion.html", name="membre_connexion")
     */

    public function connexion(AuthenticationUtils $authenticationUtils)
    {
        # Récupération du formulaire de connexion
        $form = $this->createForm(ConnexionFormType::class, [
            'email' => $authenticationUtils->getLastUsername()
        ]);

        # Affichage du formulaire dans la vue
        return $this->render('membre/connexion.html.twig', [
            'form' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/deconnexion.html", name="membre_deconnexion")
     */
    public function deconnexion()
    {
    }

    /**
     * Supprimer de son compte membre
     * @Route("/deleteAccount/{id}.html", name="membre_deleteMembre")
     */
    public function deleteMembre($id)
    {

        $currentUserId = $this->getUser()->getId();
        if ($currentUserId == $id)
        {
            $session = $this->get('session');
            $session = new Session();
            $session->invalidate();
        }

        $membre = $this->getUser();

        $evenements = $membre->getEvenements();

        $em = $this->getDoctrine()->getManager();
        foreach ($evenements as $evenement){
            $em->remove($evenement);
            $em->flush();
        }


        $em->remove($membre);
        $em->flush();

        return $this->redirectToRoute('accueil');
    }

}