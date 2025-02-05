<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class ArticleController extends AbstractController
{
    #[Route('/api/article', name: 'create_article', methods: ['POST'])]
    public function createArticle(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        // Get the logged-in user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$user instanceof UserInterface) {
            return $this->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        // Create a new article with the logged-in user's email as the author
        $article = new Article();
        $article->setTitle($data['title']);
        $article->setContent($data['content']);
        $article->setAuthor($user->getEmail());

        // Persist the new article to the database
        $entityManager->persist($article);
        $entityManager->flush();

        return $this->json(['message' => 'Article created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/api/articles', name: 'get_articles', methods: ['GET'])]
    public function getArticles(EntityManagerInterface $entityManager): Response
    {
        $articles = $entityManager->getRepository(Article::class)->findAll();
        return $this->json($articles);
    }

    #[Route('/api/articles/{id}', name: 'get_article', methods: ['GET'])]
    public function getArticle(EntityManagerInterface $entityManager, int $id): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($id);
        return $this->json($article);
    }

    #[Route('/api/article/{id}', name: 'update_article', methods: ['PUT'])]
    public function updateArticle(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        // Fetch the article by ID
        $article = $entityManager->getRepository(Article::class)->find($id);
        if (!$article) {
            return $this->json(['message' => 'Article not found'], Response::HTTP_NOT_FOUND);
        }

        // Get the logged-in user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$user instanceof UserInterface || $user->getEmail() !== $article->getAuthor()) {
            return $this->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        // Update the article's title and content
        $article->setTitle($data['title']);
        $article->setContent($data['content']);

        // Save the changes to the database
        $entityManager->flush();

        return $this->json(['message' => 'Article updated successfully'], Response::HTTP_OK);
    }

    #[Route('/api/article/{id}', name: 'delete_article', methods: ['DELETE'])]
    public function deleteArticle(EntityManagerInterface $entityManager, int $id): Response
    {
        // Fetch the article by ID
        $article = $entityManager->getRepository(Article::class)->find($id);
        if (!$article) {
            return $this->json(['message' => 'Article not found'], Response::HTTP_NOT_FOUND);
        }

        // Get the logged-in user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$user instanceof UserInterface || $user->getEmail() !== $article->getAuthor()) {
            return $this->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        // Remove the article from the database
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->json(['message' => 'Article deleted successfully'], Response::HTTP_OK);
    }
}
