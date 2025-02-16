<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250215125443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE nom nom VARCHAR(50) DEFAULT NULL, CHANGE prenom prenom VARCHAR(50) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE mdp mdp VARCHAR(255) DEFAULT NULL, CHANGE statut_compte statut_compte VARCHAR(20) DEFAULT NULL, CHANGE empreinte empreinte VARCHAR(255) DEFAULT NULL, CHANGE role role VARCHAR(30) DEFAULT NULL, CHANGE groupe_sanguin groupe_sanguin VARCHAR(20) DEFAULT NULL, CHANGE tel tel VARCHAR(9) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE zipcode zipcode VARCHAR(10) DEFAULT NULL, CHANGE gouvernorat gouvernorat VARCHAR(20) DEFAULT NULL, CHANGE sexe sexe VARCHAR(10) DEFAULT NULL, CHANGE img img VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE mdp mdp VARCHAR(255) NOT NULL, CHANGE statut_compte statut_compte VARCHAR(20) NOT NULL, CHANGE empreinte empreinte VARCHAR(255) NOT NULL, CHANGE role role VARCHAR(30) NOT NULL, CHANGE groupe_sanguin groupe_sanguin VARCHAR(20) NOT NULL, CHANGE tel tel VARCHAR(9) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE zipcode zipcode VARCHAR(10) NOT NULL, CHANGE gouvernorat gouvernorat VARCHAR(20) NOT NULL, CHANGE sexe sexe VARCHAR(10) NOT NULL, CHANGE img img VARCHAR(255) NOT NULL');
    }
}
