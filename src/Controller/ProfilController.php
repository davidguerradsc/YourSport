<?php

namespace App\Controller;


use App\Form\ProfilFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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



    /**
     * Editer son Profil
     * @Route("/editprofil.html", name="membre_editProfil")
     */
    public function editProfil(Request $request)
    {
        $membre = $this->getUser();


        $form = $this->createForm(ProfilFormType::class, $membre)
            ->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() )
        {

            # Mise à jour en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            # Notification
            $this->addFlash('notice',
                'Votre profil a bien été édité !');

            # Redirection
            return $this->redirectToRoute('membre_viewProfil');

        }

        # Affichage du formulaire dans la vue
        return $this->render("Membre/editProfil.html.twig",[
            'form' => $form->createView()
        ]);
    }
}