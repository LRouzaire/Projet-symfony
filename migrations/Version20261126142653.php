<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261126142653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, lieu VARCHAR(100) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE entrainement (id INT AUTO_INCREMENT NOT NULL, date_entrainement DATE NOT NULL, heure TIME NOT NULL, lieu VARCHAR(100) NOT NULL, objectif LONGTEXT DEFAULT NULL, entraineur_id INT NOT NULL, equipe_id INT NOT NULL, INDEX IDX_A27444E5F8478A1 (entraineur_id), INDEX IDX_A27444E56D861B89 (equipe_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE entraineur (id INT AUTO_INCREMENT NOT NULL, poste VARCHAR(50) NOT NULL, utilisateur_id INT NOT NULL, UNIQUE INDEX UNIQ_3D247E87FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, categroie VARCHAR(50) NOT NULL, championnat VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, date_naissance DATE NOT NULL, num_maillot INT NOT NULL, poste VARCHAR(50) NOT NULL, utilisateur_id INT NOT NULL, equipe_id INT NOT NULL, UNIQUE INDEX UNIQ_FD71A9C5FB88E14F (utilisateur_id), INDEX IDX_FD71A9C56D861B89 (equipe_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE objectif (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, date_creation DATE NOT NULL, date_echeance DATE DEFAULT NULL, statut VARCHAR(50) NOT NULL, joueur_id INT NOT NULL, INDEX IDX_E2F86851A9E2D76C (joueur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, points INT NOT NULL, rebonds INT NOT NULL, passes_decisives INT NOT NULL, contres INT NOT NULL, date_performance DATE NOT NULL, joueur_id INT NOT NULL, rencontre_id INT NOT NULL, INDEX IDX_82D79681A9E2D76C (joueur_id), INDEX IDX_82D796816CFC0818 (rencontre_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, date_match DATE NOT NULL, lieu VARCHAR(100) NOT NULL, score_domicile INT DEFAULT NULL, score_exterieur INT DEFAULT NULL, competition_id INT NOT NULL, equipe_domicile_id INT NOT NULL, equipe_exterieure_id INT NOT NULL, INDEX IDX_460C35ED7B39D312 (competition_id), INDEX IDX_460C35ED5FE1AEAD (equipe_domicile_id), INDEX IDX_460C35ED8923FCCA (equipe_exterieure_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE entrainement ADD CONSTRAINT FK_A27444E5F8478A1 FOREIGN KEY (entraineur_id) REFERENCES entraineur (id)');
        $this->addSql('ALTER TABLE entrainement ADD CONSTRAINT FK_A27444E56D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE entraineur ADD CONSTRAINT FK_3D247E87FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C56D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE objectif ADD CONSTRAINT FK_E2F86851A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D79681A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D796816CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED5FE1AEAD FOREIGN KEY (equipe_domicile_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED8923FCCA FOREIGN KEY (equipe_exterieure_id) REFERENCES equipe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrainement DROP FOREIGN KEY FK_A27444E5F8478A1');
        $this->addSql('ALTER TABLE entrainement DROP FOREIGN KEY FK_A27444E56D861B89');
        $this->addSql('ALTER TABLE entraineur DROP FOREIGN KEY FK_3D247E87FB88E14F');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5FB88E14F');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C56D861B89');
        $this->addSql('ALTER TABLE objectif DROP FOREIGN KEY FK_E2F86851A9E2D76C');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D79681A9E2D76C');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D796816CFC0818');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED7B39D312');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED5FE1AEAD');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED8923FCCA');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE entrainement');
        $this->addSql('DROP TABLE entraineur');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE objectif');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
