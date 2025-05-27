<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Service\FactureManager;
use App\Service\FactureManagerInterface;
use App\Dto\FactureDto;
use App\Form\Type\FactureType;
use App\Service\ClientManager;
use App\Service\ClientManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('client/{cid}/facture', name: 'app_facture')]
final class FactureController extends AbstractController
{
    private FactureManagerInterface $factureManager;
    private ClientManagerInterface $clientManager;
    public function __construct(FactureManagerInterface $factureManager,ClientManagerInterface $clientManager)
    {
        $this->factureManager = $factureManager;
        $this->clientManager = $clientManager;
    }
    #[Route('/add', name: '_add')]
    public function add(int $cid, Request $request): Response
    {
        $factureDto = new FactureDto();
        $client = $this->clientManager->getClientById($cid);
        $form = $this->createForm(FactureType::class, data: $factureDto);
        $factureDto->setClient($client);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $facture = $factureDto->toEntity();
            $this->factureManager->createFacture(facture: $facture);

            $this->addFlash('success', 'Facture added successfully!');
            return $this->redirectToRoute('app_client_view', [
                'id' => $facture->getClient()->getId(),
            ]);
        }
        return $this->render('facture/add.html.twig', [
            'form' => $form->createView(),
            'facture' => $factureDto,
        ]);
    }
    #[Route('/edit/{id}', name: '_edit')]
    public function edit(int $cid, int $id, Request $request): Response
    {
        $facture = $this->factureManager->getFactureById($id);
        if ($facture->getClient()->getId() !== $cid) {
            throw $this->createNotFoundException('Facture not found for this client.');
        }
        
        $factureDto = (new FactureDto())->fromEntity($facture);
        $form = $this->createForm(FactureType::class, data: $factureDto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $facture = $factureDto->toEntity();
            $this->factureManager->updateFacture( $facture);

            $this->addFlash('success', 'Facture updated successfully!');
            return $this->redirectToRoute('app_client_view', [
                'id' => $facture->getClient()->getId(),
            ]);
        }

        return $this->render('facture/edit.html.twig', [
            'form' => $form->createView(),
            'facture' => $factureDto,
        ]);
    }

    #[Route('/view/{id}', name: '_view')]
    public function view(int $cid, int $id): Response
    {
        $facture = $this->factureManager->getFactureById($id);
        if ($facture->getClient()->getId() !== $cid) {
            throw $this->createNotFoundException('Facture not found for this client.');
        }
        $factureDto = (new FactureDto())->fromEntity($facture);
        return $this->render('facture/view.html.twig', [
            'facture' => $factureDto,
        ]);
    }

}
