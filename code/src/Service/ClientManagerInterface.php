<?php
namespace App\Service;
use App\Entity\Client;

interface ClientManagerInterface
{
    public function addClient(Client $client): void;
    public function getClientById(int $id): ?Client;
    public function updateClient(Client $client): void;
    public function deleteClient(int $id): void;
    public function getAllClients(): array;
} 