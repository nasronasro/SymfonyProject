<?php
namespace App\Service;

use App\Entity\Facture;

interface FactureManagerInterface
{
    public function createFacture(Facture $facture);
    public function updateFacture(Facture $facture);
    public function getFactureById(int $id);
    public function getAllFactures(): array;
    public function getFacturesByClientId(int $clientId): array;

}

