<?php


namespace App\Controller;


use App\Entity\Sports;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{


    /**
     * Page D'accueil
     *
     */
    public function index()
    {
        return $this->render("default/index.html.twig");
    }


    /**
     * recup des sport en BDD et affichage des événement trié par sport
     * @Route("/sports/{slug}",
     *     defaults={"slug"="Tous les sports"},
     *     name="default_listsport")
     */
    public function sport($slug)
    {
        /*
         * Récuperation du sport correspondant au slug passé en parametre dans la route
         * ---------------------------------
         * Recup du "Slug" dans la variable $slug
         */
        $sport = $this->getDoctrine()
            ->getRepository(Sports::class)
            ->findOneBy(['slug' => $slug]);


        /*
         * Récup des événements du sport selectionné
         */
        $evenements = $sport->getEvenements();

        /*
         * affichage dans la vue
         */

        return $this->render("evenement/eventbysport.html.twig",[
            'evenements' => $evenements,
            'sport' => $sport
        ]);


    }


}