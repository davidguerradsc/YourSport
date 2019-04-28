<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class DefaultController
{

    public function index()
    {
        return new Response("<html><body><h1>PAGE D'ACCUEIL</h1></body></html>");
    }
}