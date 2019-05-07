<?php

namespace App\Controller;

use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participer/{id}", name="evenement_participer")
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
}