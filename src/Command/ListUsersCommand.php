<?php
// src/Command/ListUsersCommand.php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListUsersCommand extends Command
{
    protected static $defaultName = 'app:list-users';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:list-users') // Explicitly setting the command name
            ->setDescription('List all users');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        foreach ($users as $user) {
            $io->text($user->getEmail());
        }

        $io->success('Users listed successfully.');

        return Command::SUCCESS;
    }
}
