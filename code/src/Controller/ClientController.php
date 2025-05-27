<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ClientManagerInterface;
use App\Service\FactureManagerInterface;
use App\Dto\ClientDto;
use App\Dto\FactureDto;
use App\Entity\Facture;
use App\Form\Type\ClientType;
use Symfony\Component\HttpFoundation\Request;
#[Route(path: '/client', name: 'app_client')]
final class ClientController extends AbstractController
{
    private ClientManagerInterface $clientManager;
    private FactureManagerInterface $factureManager;

    public function __construct(ClientManagerInterface $clientManager, FactureManagerInterface $factureManager)
    {
        $this->clientManager = $clientManager;
        $this->factureManager = $factureManager;
    }

    #[Route(path: '/', name: '')]
    public function index(): Response
    {
        $clients = $this->clientManager->getAllClients();
        
        $clientDtos = array_map(function(Client $client) {
            return ClientDto::fromEntity($client);
        }, $clients);

        $this->addFlash('success', 'Clients loaded successfully!');

        return $this->render('client/index.html.twig', [
            'clients' => $clientDtos,
        ]);
    }

    #[Route(path: '/add', name: '_add') ]
    public function add(Request $request): Response
    {
        
        $clientDto = new ClientDto();
        $form = $this->createForm(ClientType::class, $clientDto);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $currentUser = $this->getUser();

            $client = $clientDto->toEntity();
            $client->setUser($currentUser);

            $this->clientManager->addClient($client);

            $this->addFlash('success', 'Client added successfully!');
            return $this->redirectToRoute('app_client');
        }

        return $this->render('client/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/edit/{id}', name: '_edit')]
    public function edit(Request $request, int $id): Response
    {
        $client = $this->clientManager->getClientById($id);
        $clientDto = ClientDto::fromEntity($client);
        $form = $this->createForm(ClientType::class, $clientDto);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client = $clientDto->toEntity();
            $this->clientManager->updateClient($client);

            $this->addFlash('success', 'Client updated successfully!');

            return $this->redirectToRoute('app_client');
        }

        return $this->render('client/edit.html.twig', [
            'form' => $form->createView(),
            'client' => $clientDto,
        ]);
    }
    #[Route(path: '/delete/{id}', name: '_delete')]
    public function delete(int $id): Response
    {
        try {
            $this->clientManager->deleteClient($id);
            $this->addFlash('success', 'Client deleted successfully!');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Error deleting client: ' . $e->getMessage());
        }

        return $this->redirectToRoute('app_client');
    }
    #[Route(path: '/view/{id}', name: '_view')]
    public function view(int $id): Response
    {
        $client = $this->clientManager->getClientById($id);
        if (!$client) {
            throw $this->createNotFoundException('Client not found');
        }
        $factures = $this->factureManager->getAllFactures();
        $facturesDto =  array_map(function (Facture $facture) {
            return (new FactureDto())->fromEntity($facture);
        }, $factures);

        $clientDto = ClientDto::fromEntity($client);

        return $this->render('client/view.html.twig', [
            'client' => $clientDto,
            'factures' => $facturesDto,
        ]);
    }
}
