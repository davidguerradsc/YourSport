<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * Page Profil
     * @Route("/profil.html", name="membre_viewProfil")
     */
    public function viewProfil()
    {
        return $this->render("membre/profil.html.twig");
    }
}