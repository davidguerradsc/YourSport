<?php

namespace App\Controller;

use App\Entity\Evenement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * Fonction permettant de rejoindre un événement ( ajouter un particpant ).
     * @Route("/participer/{id}.html", name="evenement_participer")
     * @param Evenement $evenement
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function joinEvent(Evenement $evenement)
    {
        $evenement->addParticipant($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('evenement_evenement', [
            'sports' => $evenement->getSport()->getSlug(),
            'slug' => $evenement->getSlug(),
            'id' => $evenement->getId()
        ]);

    }

    /**
     * Fonction permettant de quitter un événement.
     * @Route("/desinscrire/{id}.html", name="evenement_leaveEvent")
     * @param Evenement $evenement
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function leaveEvent(Evenement $evenement)
    {
        $evenement->removeParticipant($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('evenement_evenement', [
            'sports' => $evenement->getSport()->getSlug(),
            'slug' => $evenement->getSlug(),
            'id' => $evenement->getId()
        ]);
    }
}