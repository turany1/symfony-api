<?php

namespace App\Tests\Repository;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testFindUserByEmail(): void
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'user1@example.com']);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('user1@example.com', $user->getEmail());
    }

    public function testFindAllUsers(): void
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $this->assertGreaterThan(0, count($users));
    }

    public function testUserExists(): void
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'user1@example.com']);
        $this->assertTrue($user !== null);
    }
}
