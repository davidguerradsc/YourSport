<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{


    /**
     * Page D'accueil
     *
     */
    public function index()
    {
        return $this->render("default/index.html.twig");
        #return new Response("<html><body><h1>PAGE D'ACCUEIL</h1></body></html>");
    }
}