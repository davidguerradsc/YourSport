<?php

namespace App\Controller;


use App\Entity\Evenement;
use App\Entity\Membre;
use App\Form\EvenementFormType;
use function Sodium\crypto_box_publickey_from_secretkey;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class EvenementController extends AbstractController
{

    use HelperTrait;

    /**
     * Formulaire de création d'événement
     * @Route("/creer-un-evenement.html", name="evenement_createEvenement")
     */
    public function createEvenement(Request $request)
    {
        # Création d'un nouvel Evenement
        $evenement = new Evenement();

        # Récupération du Membre créateur
        $membre = $this->getDoctrine()
            ->getRepository(Membre::class)
            ->find($this->getUser()->getID());

        # Affecter le membre connecté à l'Evénement
        $evenement->setMembre($membre);

        # Création d'un Formulaire permettant l'ajout d'un Evénement
        $form = $this->createForm(EvenementFormType::class, $evenement);

        # Traitement des données POST
        $form->handleRequest($request);

        # Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            # 1. Génération du slug
            $evenement->setSlug($this->slugify($evenement->getTitre()));

            # 2. Sauvegarde en base de donnée
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();

            # 3. Notification
//            $this->addFlash('notice', 'Félicitations votre événement à bien été crée !');

            # 4. Redirection
            return $this->redirectToRoute('evenement_evenement', ['sports' => $evenement->getSport()->getSlug(),
                'slug' => $evenement->getSlug(),
                'id' => $evenement->getId()]);
        }

        return $this->render("evenement/eventform.html.twig", ['form' => $form->createView()]);
    }


    /**
     * Pour lister tous les événements
     * @Route("/liste-des-evenements.html", name="evenement_list")
     */
    public function findEvent()
    {

        $repository = $this->getDoctrine()
            ->getRepository(Evenement::class);

        $evenements = $repository->findEvent();

        return $this->render("evenement/findevent.html.twig", [
            'evenements' => $evenements
        ]);
    }

    /**
     * Lister les 4 derniers événements
     * @Route("/", name="evenement_latest")
     */
    public function findLatest()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Evenement::class);

        $lastevents = $repository->findLatest();

        return $this->render("default/index.html.twig", [
            'lastevents' => $lastevents
        ]);

    }

    /**
     * Fonction permettant d'afficher un événement
     * @Route("/{sports}/{slug}_{id<\d+>}.html",
     * name="evenement_evenement")
     */
    public function evenement($id)
    {

        /*
         * Récup de l'ID passé en parametre dans la route
         */

        $evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->find($id);

        /*
         * On passe à la vue
         */
        return $this->render("evenement/evenement.html.twig", [
            'evenement' => $evenement
        ]);

    }


    /**
     * Recupérer les événements triés par membre
     * @Route("/my-events",
     *     name="evenement_eventByMember")
     */
    public function eventByMember()
    {

        $membre = $this->getUser();

        /*
         * Récup des événements du membre sélectionné
         */
        $evenements = $membre->getEvenements();

        /*
         * Affichage dans la vue
         */
        return $this->render("evenement/eventByMember.html.twig",[
            'evenements' => $evenements,
            'membre' => $membre
        ]);
    }



}