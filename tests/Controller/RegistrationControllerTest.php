<?php 

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegisterNewUser(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/register', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'email' => 'user4@example.com',
            'password' => 'password'
        ]));

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testRegisterUsedEmail(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/register', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'email' => 'user@example.com',
            'password' => 'password'
        ]));

        $this->assertEquals(409, $client->getResponse()->getStatusCode());
    }
}
