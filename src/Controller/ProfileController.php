<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    #[Route('/api/profile', name: 'api_profile', methods: ['GET'])]
    public function profile(): JsonResponse
    {
        // Get the logged-in user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        
        if (!$user instanceof User) {
            return $this->json(['message' => 'Unauthorized'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Return user information
        return $this->json([
            'email' => $user->getEmail(),
        ]);
    }
}
