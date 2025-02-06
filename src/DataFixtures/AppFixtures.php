<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        
        //Add Articles

        $article1 = new Article();
        $article1->setTitle('First Article');
        $article1->setContent('This is the content of the first article.');
        $article1->setAuthor('user2@example.com');
        $manager->persist($article1);

        $article2 = new Article();
        $article2->setTitle('Second Article');
        $article2->setContent('This is the content of the second article.');
        $article2->setAuthor('user3@example.com');
        $manager->persist($article2);


        //Add Users

        $user1 = new User();
        $user1->setEmail('user@example.com');
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword($this->passwordHasher->hashPassword(
            $user1,
            'password'
        ));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('user2@example.com');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword($this->passwordHasher->hashPassword(
            $user2,
            'password'
        ));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('user3@example.com');
        $user3->setRoles(['ROLE_USER']);
        $user3->setPassword($this->passwordHasher->hashPassword(
            $user3,
            'password'
        ));
        $manager->persist($user3);

        
        $manager->flush();
    }
}
