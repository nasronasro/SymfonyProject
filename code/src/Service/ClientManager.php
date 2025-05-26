<?php
namespace App\Service;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;

class ClientManager implements ClientManagerInterface
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function addClient(Client $client): void
    {
        $this->entityManager->getRepository(Client::class)->add($client, true);
    }

    public function getClientById(int $id): ?Client
    {
        $client = $this->entityManager->getRepository(Client::class)->find($id);
        return $client;
    }

	public function updateClient(Client $client): void
	{
        if (!$client->getId()) {
            throw new \Exception("Client ID is required for update");
        }
        $this->entityManager->getRepository(Client::class)->update($client, true);
	}

	public function deleteClient($id): void
	{
        if (!$id) {
            throw new \Exception("Client ID is required for deletion");
        }
        $client = $this->getClientById($id);
        $this->entityManager->getRepository(Client::class)->remove($client, true);
	}

    public function getAllClients(): array
    {
        $clients = $this->entityManager->getRepository(Client::class)->findAll();
        return $clients;
    }
}