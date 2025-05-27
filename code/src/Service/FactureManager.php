<?php
namespace App\Service;

use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;

class FactureManager implements FactureManagerInterface
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function createFacture(Facture $facture)
    {
        $facture->setNfactureNumber('F' . date('YmdHis'));
        $this->entityManager->getRepository(Facture::class)->save($facture,true);
    }

    public function updateFacture(Facture $facture)
    {
        $this->entityManager->getRepository(Facture::class)->update($facture, true);
    }


    public function getFactureById(int $id)
    {
        $facture = $this->entityManager->getRepository(Facture::class)->find($id);
        if (!$facture) {
            throw new \Exception("Facture not found");
        }
        return $facture;
    }

    public function getAllFactures(): array
    {
        $factures = $this->entityManager->getRepository(Facture::class)->findAll();
        if ($factures) {
            return $factures;
        }
        return [];
    }

    public function getFacturesByClientId(int $clientId): array
    {
        $factures = $this->entityManager->getRepository(Facture::class)->findBy(['client' => $clientId]);
        if ($factures) {
            return $factures;
        }
        return [];
    }
}