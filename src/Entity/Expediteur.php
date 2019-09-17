<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpediteurRepository")
 */
class Expediteur
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
    private $nomexp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomexp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telexp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="expediteur")
     */
    private $transactions;

  

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomexp(): ?string
    {
        return $this->nomexp;
    }

    public function setNomexp(string $nomexp): self
    {
        $this->nomexp = $nomexp;

        return $this;
    }

    public function getPrenomexp(): ?string
    {
        return $this->prenomexp;
    }

    public function setPrenomexp(string $prenomexp): self
    {
        $this->prenomexp = $prenomexp;

        return $this;
    }

    public function getTelexp(): ?string
    {
        return $this->telexp;
    }

    public function setTelexp(string $telexp): self
    {
        $this->telexp = $telexp;

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
            $transaction->setExpediteur($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getExpediteur() === $this) {
                $transaction->setExpediteur(null);
            }
        }

        return $this;
    }

   
}
