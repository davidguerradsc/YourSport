<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


class Contact
{
    /**
     * @ORM\Column(type="string", length=180)
     * @Assert\NotBlank(message="Veuillez saisir votre adresse email")
     * @Assert\Length( max="255", maxMessage="Limité à {{ limit }} caractères.")
     *  @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",
     *     message="Veuillez entrer une adresse mail valide")
     */
    private $email;

    /**
     * @Assert\NotBlank(message="Veuillez saisir un message de plus de 10 caractères")
     * @Assert\Length(min="10")
     */
    private $message;


    /**
     * @Assert\NotBlank(message="Veuillez saisir votre Nom")
     * @Assert\Length(min="2")
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="Veuillez saisir votre Prénom")
     * @Assert\Length(min="2")
     */
    private $prenom;
    /*
     *------------------EMAIL ------------------
     */


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /*
     *------------------MESSAGE ------------------
     */

    public function getMessage(): ?string
    {
        return $this->message;
    }


    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }



    /*
     *------------------LASTNAME ------------------
     */


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /*
     *------------------FIRSTNAME ------------------
     */


    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }


}