<?php

namespace App\Tests\Repository;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleRepositoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }

    public function testFindAllArticles(): void
    {
        $articles = $this->entityManager->getRepository(Article::class)->findAll();
        $this->assertGreaterThan(0, count($articles));
    }
}
