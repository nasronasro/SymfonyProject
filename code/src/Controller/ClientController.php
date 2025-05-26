<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ClientManagerInterface;
use App\Dto\ClientDto;
use App\Form\Type\ClientType;
use Symfony\Component\HttpFoundation\Request;

#[Route('/client', name: 'app_client')]
final class ClientController extends AbstractController
{
    private ClientManagerInterface $clientManager;

    public function __construct(ClientManagerInterface $clientManager)
    {
        $this->clientManager = $clientManager;
    }

    #[Route(path: '', name: '')]
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
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $currentUser = $this->getUser();

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

        $form = $this->createForm(ClientType::class, $client);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->clientManager->updateClient($client);

            $this->addFlash('success', 'Client updated successfully!');

            return $this->redirectToRoute('app_client');
        }

        return $this->render('client/edit.html.twig', [
            'form' => $form->createView(),
            'client' => ClientDto::fromEntity($client),
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
    #[Route(path: '/{id}', name: '_view')]
    public function view(int $id): Response
    {
        $client = $this->clientManager->getClientById($id);
        if (!$client) {
            throw $this->createNotFoundException('Client not found');
        }

        $clientDto = ClientDto::fromEntity($client);

        return $this->render('client/view.html.twig', [
            'client' => $clientDto,
        ]);
    }
}
