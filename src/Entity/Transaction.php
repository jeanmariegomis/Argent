<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $code;

    /**
     * @ORM\Column(type="bigint")
     */
    private $Montant;

    /**
     * @ORM\Column(type="bigint")
     */
    private $comenvoi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comretrait;

    /**
     * @ORM\Column(type="bigint")
     */
    private $cometat;

    /**
     * @ORM\Column(type="bigint")
     */
    private $comsys;

    /**
     * @ORM\Column(type="bigint")
     */
    private $frais;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateenvoi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Expediteur", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $expediteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Beneficiaire", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $beneficiaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->Montant;
    }

    public function setMontant(int $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getComenvoi(): ?int
    {
        return $this->comenvoi;
    }

    public function setComenvoi(int $comenvoi): self
    {
        $this->comenvoi = $comenvoi;

        return $this;
    }

    public function getComretrait(): ?string
    {
        return $this->comretrait;
    }

    public function setComretrait(string $comretrait): self
    {
        $this->comretrait = $comretrait;

        return $this;
    }

    public function getCometat(): ?int
    {
        return $this->cometat;
    }

    public function setCometat(int $cometat): self
    {
        $this->cometat = $cometat;

        return $this;
    }

    public function getComsys(): ?int
    {
        return $this->comsys;
    }

    public function setComsys(int $comsys): self
    {
        $this->comsys = $comsys;

        return $this;
    }

    public function getFrais(): ?int
    {
        return $this->frais;
    }

    public function setFrais(int $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateenvoi(): ?\DateTimeInterface
    {
        return $this->dateenvoi;
    }

    public function setDateenvoi(\DateTimeInterface $dateenvoi): self
    {
        $this->dateenvoi = $dateenvoi;

        return $this;
    }

    public function getExpediteur(): ?Expediteur
    {
        return $this->expediteur;
    }

    public function setExpediteur(?Expediteur $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    public function getBeneficiaire(): ?Beneficiaire
    {
        return $this->beneficiaire;
    }

    public function setBeneficiaire(?Beneficiaire $beneficiaire): self
    {
        $this->beneficiaire = $beneficiaire;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }
}
