<?php
/*
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Entity\User;
use App\Entity\Article;

class FeatureContext extends MinkContext implements Context
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given there is an article titled :title with content :content
     *//*
    public function thereIsAnArticleTitledWithContent($title, $content)
    {
        $entityManager = $this->kernel->getContainer()->get('doctrine')->getManager();
        $author = $entityManager->getRepository(User::class)->findOneBy(['email' => 'author@example.com']);
        if (!$author) {
            $author = new User();
            $author->setEmail('author@example.com');
            $author->setRoles(['ROLE_AUTHOR']);
            $entityManager->persist($author);
            $entityManager->flush();
        }

        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        $article->setAuthor($author);
        $entityManager->persist($article);
        $entityManager->flush();
    }

    /**
     * @Given there are articles titled :titleOne, :titleTwo, and :titleThree
     *//*
    public function thereAreArticlesTitledAnd($titleOne, $titleTwo, $titleThree)
    {
        $this->thereIsAnArticleTitledWithContent($titleOne, 'Content for ' . $titleOne);
        $this->thereIsAnArticleTitledWithContent($titleTwo, 'Content for ' . $titleTwo);
        $this->thereIsAnArticleTitledWithContent($titleThree, 'Content for ' . $titleThree);
    }

    /**
     * @Given I am logged in as :email with :password
     *//*
    public function iAmLoggedInAsWith($email, $password)
    {
        $this->visit('/login');
        $this->fillField('email', $email);
        $this->fillField('password', $password);
        $this->pressButton('Login');
    }
}
*/