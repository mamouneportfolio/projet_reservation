<?php
namespace App\Controller\Api;

use App\Entity\Appointment;
use App\Repository\AppointmentRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/appointments')]
class AppointmentController extends AbstractController {
    #[Route('', methods: ['GET'])]
    public function index(AppointmentRepository $repo): JsonResponse {
        $user = $this->getUser();
        if (!$user) return new JsonResponse([], 401);

        $appointments = $repo->findBy(['user' => $user]);
        $data = array_map(fn($ap) => [
            'id' => $ap->getId(),
            'service_name' => $ap->getService() ? $ap->getService()->getName() : 'Inconnu',
            'date' => $ap->getDate() ? $ap->getDate()->format('d/m/Y H:i') : 'N/A'
        ], $appointments);

        return new JsonResponse($data);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em, ServiceRepository $sRepo): JsonResponse {
        $user = $this->getUser();
        $data = json_decode($request->getContent(), true);
        $service = $sRepo->find($data['service_id'] ?? 0);

        if (!$user || !$service) return new JsonResponse(['error' => 'Data missing'], 400);

        $ap = new Appointment();
        $ap->setUser($user);
        $ap->setService($service);
        $ap->setDate(new \DateTime());

        $em->persist($ap);
        $em->flush();
        return new JsonResponse(['status' => 'ok'], 201);
    }
}
