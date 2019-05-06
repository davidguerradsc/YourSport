<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 */
class Membre implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message="Veuillez saisir votre nom")
     * @Assert\Length( max="255", maxMessage="Limité à {{ limit }} caractères.")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message="Veuillez saisir votre prénom")
     * @Assert\Length( max="255", maxMessage="Limité à {{ limit }} caractères.")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message="Veuillez choisir un pseudo")
     * @Assert\Length( max="255", maxMessage="Limité à {{ limit }} caractères.")
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=180)
     * @Assert\NotBlank(message="Veuillez saisir votre adresse email")
     * @Assert\Length( max="255", maxMessage="Limité à {{ limit }} caractères.")
     *  @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",
     *     message="Veuillez entrer une adresse mail valide"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank(message="Veuillez saisir un mot de passe")
     * @Assert\Length( max="255", maxMessage="Limité à {{ limit }} caractères.")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date
     * @Assert\NotNull(message="Veuillez saisir votre date de naissance")
     */
    private $date_de_naissance;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Veuillez saisir votre ville")
     * @Assert\Length( max="255", maxMessage="Limité à {{ limit }} caractères.")
     */
    private $ville;

    /**
     * @ORM\Column(type="integer", length=50)
     * @Assert\NotBlank(message="Veuillez indiquez votre département")
     * @Assert\Type(
     *     type="integer",
     *     message="Vous devez indiquer votre département en chiffre uniquement. ex: 75, 78, 95 .."
     * )
     * @Assert\Regex(
     *     pattern="/^[0-9]{2}$/",
     *     message="Vous devez indiquer votre département en chiffre uniquement. ex: 75, 78, 95 .."
     * )
     */
    private $departement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_inscription;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="membre")
     */
    private $evenements;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Evenement", mappedBy="participant")
     */
    private $participation;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->participation = new ArrayCollection();
        $this->date_inscription = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDepartement(): ?int
    {
        return $this->departement;
    }

    public function setDepartement(int $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setMembre($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->contains($evenement)) {
            $this->evenements->removeElement($evenement);
            // set the owning side to null (unless already changed)
            if ($evenement->getMembre() === $this) {
                $evenement->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getParticipation(): Collection
    {
        return $this->participation;
    }

    public function addParticipation(Evenement $participation): self
    {
        if (!$this->participation->contains($participation)) {
            $this->participation[] = $participation;
            $participation->addParticipant($this);
        }

        return $this;
    }

    public function removeParticipation(Evenement $participation): self
    {
        if ($this->participation->contains($participation)) {
            $this->participation->removeElement($participation);
            $participation->removeParticipant($this);
        }

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_MEMBRE'];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
}
