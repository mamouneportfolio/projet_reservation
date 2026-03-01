<?php
namespace App\Controller\Api;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController {
    #[Route('/api/services', methods: ['GET'])]
    public function index(ServiceRepository $repo): JsonResponse {
        return $this->json($repo->findAll(), 200, [], ['groups' => 'service:read']);
    }
}
