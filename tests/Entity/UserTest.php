<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserGettersAndSetters(): void
    {
        $user = new User();
        $user->setEmail('user1@example.com');
        $user->setRoles(['ROLE_USER']);

        $this->assertEquals('user1@example.com', $user->getEmail());
        $this->assertEquals(['ROLE_USER'], $user->getRoles());
    }
}
