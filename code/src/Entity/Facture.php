<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $NfactureNumber = null;

    #[ORM\Column]
    private ?\DateTime $factureDate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $montant = null;

    #[ORM\Column(length: 15)]
    private ?string $state = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNfactureNumber(): ?string
    {
        return $this->NfactureNumber;
    }

    public function setNfactureNumber(string $NfactureNumber): static
    {
        $this->NfactureNumber = $NfactureNumber;

        return $this;
    }

    public function getFactureDate(): ?\DateTime
    {
        return $this->factureDate;
    }

    public function setFactureDate(\DateTime $factureDate): static
    {
        $this->factureDate = $factureDate;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }
}
