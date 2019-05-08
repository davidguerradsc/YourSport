<?php

namespace App\Service\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('summarize', function($contenu){

                // Suppression des balises HTML
                $string = strip_tags($contenu);

                // Si mon $string est supérieur à 50, je continue
                if (strlen($string) > 50) {

                    // Je m'assure de ne pas couper un mot.
                    // En recherchant la position du dernier espace.
                    $stringCut = substr($string, 0, 50);
                    $string = substr($stringCut, 0, strrpos($stringCut, ' '));
                }

                return $string ;

            }, array( 'is_safe' => array( 'html' ) ) )
        ];
    }

}