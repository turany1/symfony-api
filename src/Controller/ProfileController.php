<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    private $entityManager;
    private $jwtSecretKey;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->jwtSecretKey = file_get_contents($_SERVER['JWT_SECRET_KEY']);
    }

    #[Route('/api/profile', name: 'api_profile', methods: ['GET'])]
    public function profile(Request $request): JsonResponse
    {
        // Extract the JWT token from the Authorization header
        $authHeader = $request->headers->get('Authorization');
        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return new JsonResponse(['message' => 'Missing or invalid Authorization header'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $jwtToken = $matches[1];

        try {
            // Decode and validate the JWT token
            $decoded = JWT::decode($jwtToken, new Key($this->jwtSecretKey, 'RS256'));

            // Get the user ID from the token claims
            $userId = $decoded->uid;

            // Find the user by ID
            $user = $this->entityManager->getRepository(User::class)->find($userId);
            if (!$user) {
                return new JsonResponse(['message' => 'User not found'], JsonResponse::HTTP_NOT_FOUND);
            }

            // Return user information
            return new JsonResponse([
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'name' => $user->getName(),
                'roles' => $user->getRoles(),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Invalid token: ' . $e->getMessage()], JsonResponse::HTTP_UNAUTHORIZED);
        }
    }
}
