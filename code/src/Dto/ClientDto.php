<?php
namespace App\Dto;

use App\Entity\Client;

class ClientDto{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $phone;
    private string $address;
    private string $city;
    private string $country;

    public static function fromEntity(Client $client): self{
        $dto = new self();
        $dto->id = $client->getId();
        $dto->firstname = $client->getFirstname();
        $dto->lastname = $client->getLastname();
        $dto->phone = $client->getPhone();
        $dto->address = $client->getAddress();
        $dto->city = $client->getCity();
        $dto->country = $client->getCountry();
        return $dto;
    }
    public function toEntity(): Client{
        $client = new Client();
        $client->setFirstname($this->getFirstname());
        $client->setLastname($this->getLastname());
        $client->setPhone($this->getPhone());
        $client->setAddress($this->getAddress());
        $client->setCity($this->getCity());
        $client->setCountry($this->getCountry());
        return $client;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }
    public function getLastname(): string
    {
        return $this->lastname;
    }
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }
    public function getCity(): string
    {
        return $this->city;
    }
    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }
    public function getCountry(): string
    {
        return $this->country;
    }
    
}