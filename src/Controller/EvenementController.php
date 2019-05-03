<?php

namespace App\Controller;


use App\Entity\Evenement;
use App\Entity\Membre;
use App\Form\EvenementFormType;
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
            ->find(3);

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
            $this->addFlash('notice', 'Félicitations votre événement à bien été crée !');

            # 4. Redirection
            return $this->redirectToRoute('accueil', ['sport' => $evenement->getSport()->getSlug(),
                                                      'slug' => $evenement->getSlug(),
                                                      'id'   => $evenement->getId()]);
        }

        return $this->render("evenement/eventform.html.twig", ['form' => $form->createView()]);
    }


    /**
     *
     * @Route("/liste-des-evenements.html", name="evenement_list")
     */
    public function findEvent()
    {

        $repository = $this->getDoctrine()
            ->getRepository(Evenement::class);

        $evenements = $repository->findEvent();

        return $this->render("evenement/findevent.html.twig",[
            'evenements' => $evenements
        ]);
    }

    /**
     * @Route("/", name="evenement_latest")
     */
    public function findLatest()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Evenement::class);

        $lastevents = $repository->findLatest();

        return $this->render("default/index.html.twig",[
            'lastevents' => $lastevents
        ]);

    }
}