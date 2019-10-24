<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeneficiaireRepository")
 */
class Beneficiaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomben;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomben;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telben;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $cni;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="beneficiaire")
     */
    private $transactions;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRetrait;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomben(): ?string
    {
        return $this->nomben;
    }

    public function setNomben(string $nomben): self
    {
        $this->nomben = $nomben;

        return $this;
    }

    public function getPrenomben(): ?string
    {
        return $this->prenomben;
    }

    public function setPrenomben(string $prenomben): self
    {
        $this->prenomben = $prenomben;

        return $this;
    }

    public function getTelben(): ?string
    {
        return $this->telben;
    }

    public function setTelben(string $telben): self
    {
        $this->telben = $telben;

        return $this;
    }

    public function getCni(): ?int
    {
        return $this->cni;
    }

    public function setCni(int $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setBeneficiaire($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getBeneficiaire() === $this) {
                $transaction->setBeneficiaire(null);
            }
        }

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->dateRetrait;
    }

    public function setDateRetrait(\DateTimeInterface $dateRetrait): self
    {
        $this->dateRetrait = $dateRetrait;

        return $this;
    }

}
