<?php
namespace App\Dto;
use App\Entity\Client;
use App\Entity\Facture;

class FactureDto
{
    private int $id;
    private string $nfactureNumber = '';
    private float $amount;
    private \DateTimeInterface $dueDate;
    private string $state;
    private ?string $comments = null;
    private Client $client;

    public function fromEntity(Facture $entity): self
    {
        $this->id = $entity->getId();
        $this->nfactureNumber = $entity->getNfactureNumber();
        $this->amount = $entity->getMontant();
        $this->dueDate = $entity->getFactureDate();
        $this->state = $entity->getState();
        $this->comments = $entity->getComment();
        $this->client = $entity->getClient();

        return $this;
    }
    public function toEntity(): Facture
    {
        $facture = new Facture();
        
        $facture->setNfactureNumber($this->nfactureNumber);
        $facture->setMontant($this->amount);
        $facture->setFactureDate($this->dueDate);
        $facture->setState($this->state);
        $facture->setComment($this->comments);
        $facture->setClient($this->client);

        return $facture;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getNfactureNumber(): string
    {
        return $this->nfactureNumber;
    }
    public function setNfactureNumber(string $nfactureNumber): self
    {
        $this->nfactureNumber = $nfactureNumber;
        return $this;
    }
    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getDueDate(): \DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;
        return $this;
    }
    public function getClient(): Client
    {
        return $this->client;
    }
    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }
}