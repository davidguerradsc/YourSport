<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir un titre")
     * @Assert\Length( max="255", maxMessage="Votre titre ne doit pas dépasser {{ limit }} caractères.")
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Veuillez indiquer votre ville.")
     */
    private $ville;

    /**
     * @ORM\Column(type="integer", length=50)
     * @Assert\NotBlank(message="Vous devez indiquer votre département.")
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
     * @ORM\Column(type="string", length=120)
     * @Assert\NotBlank(message="Veuillez indiquer le lieu de l'événement.")
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $details;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="Veuillez indiquer la date de l'événement.")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank(message="Veuillez indiquer l'heure de l'événement.")
     */
    private $heure;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="evenements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sports", inversedBy="evenements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sport;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Membre", inversedBy="participation")
     */
    private $participant;

    public function __construct()
    {
        $this->participant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getSport(): ?Sports
    {
        return $this->sport;
    }

    public function setSport(?Sports $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * @return Collection|Membre[]
     */
    public function getParticipant(): Collection
    {
        return $this->participant;
    }

    public function addParticipant(Membre $participant): self
    {
        if (!$this->participant->contains($participant)) {
            $this->participant[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(Membre $participant): self
    {
        if ($this->participant->contains($participant)) {
            $this->participant->removeElement($participant);
        }

        return $this;
    }
}
