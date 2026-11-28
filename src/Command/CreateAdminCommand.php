<?php

namespace App\Command;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Créer un compte administrateur'
)]
class CreateAdminCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);

        $io->title('Création du compte administrateur');

        // Demander les informations de l'administrateur
        $prenom = $io->ask('Prénom');
        $nom = $io->ask('Nom');
        $email = $io->ask('Adresse e-mail');

        // Vérifier si l'adresse e-mail existe déjà
        $existingUser = $this->entityManager
            ->getRepository(Utilisateur::class)
            ->findOneBy(['email' => $email]);

        if ($existingUser) {
            $io->error('Cette adresse e-mail est déjà utilisée.');

            return Command::FAILURE;
        }

        // Demander le mot de passe sans l'afficher
        $plainPassword = $io->askHidden('Mot de passe');

        // Créer le nouvel utilisateur
        $admin = new Utilisateur();

        $admin->setPrenom($prenom);
        $admin->setNom($nom);
        $admin->setEmail($email);
        $admin->setRole('ROLE_ADMIN');

        // Hacher le mot de passe
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            $plainPassword
        );

        $admin->setPassword($hashedPassword);

        // Enregistrer dans la base de données
        $this->entityManager->persist($admin);
        $this->entityManager->flush();

        $io->success('Le compte administrateur a été créé !');

        return Command::SUCCESS;
    }
}
