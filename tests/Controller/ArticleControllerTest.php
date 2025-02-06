<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testCreateArticle(): void
    {
        $client = static::createClient();
        $jwtToken = 'valid_token'; // Replace with a valid token
        $client->request('POST', '/api/articles', [], [], [
            'HTTP_Authorization' => 'Bearer ' . $jwtToken,
            'CONTENT_TYPE' => 'application/json'
        ], json_encode([
            'title' => 'New Article',
            'content' => 'This is a new article.',
            'isPublished' => true
        ]));

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
}
