<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208120422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_analyse_analyse DROP FOREIGN KEY FK_32BE54CD1EFE06BF');
        $this->addSql('ALTER TABLE detail_analyse_analyse DROP FOREIGN KEY FK_32BE54CDA5E4B669');
        $this->addSql('ALTER TABLE detail_analyse_type_analyse DROP FOREIGN KEY FK_D4163F4E3FDD09A');
        $this->addSql('ALTER TABLE detail_analyse_type_analyse DROP FOREIGN KEY FK_D4163F4EA5E4B669');
        $this->addSql('ALTER TABLE rendez_vous_analyse DROP FOREIGN KEY FK_988D1C397D348EDE');
        $this->addSql('DROP TABLE analyse');
        $this->addSql('DROP TABLE detail_analyse');
        $this->addSql('DROP TABLE detail_analyse_analyse');
        $this->addSql('DROP TABLE detail_analyse_type_analyse');
        $this->addSql('DROP TABLE disponibilite_analyse');
        $this->addSql('DROP TABLE rendez_vous_analyse');
        $this->addSql('DROP TABLE type_analyse');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE analyse (id INT AUTO_INCREMENT NOT NULL, id_analyse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, id_patient VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, id_personnel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_prelevement DATE NOT NULL, id_rendezvous VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE detail_analyse (id INT AUTO_INCREMENT NOT NULL, resultat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_resultat DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE detail_analyse_analyse (detail_analyse_id INT NOT NULL, analyse_id INT NOT NULL, INDEX IDX_32BE54CDA5E4B669 (detail_analyse_id), INDEX IDX_32BE54CD1EFE06BF (analyse_id), PRIMARY KEY(detail_analyse_id, analyse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE detail_analyse_type_analyse (detail_analyse_id INT NOT NULL, type_analyse_id INT NOT NULL, INDEX IDX_D4163F4EA5E4B669 (detail_analyse_id), INDEX IDX_D4163F4E3FDD09A (type_analyse_id), PRIMARY KEY(detail_analyse_id, type_analyse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE disponibilite_analyse (id INT AUTO_INCREMENT NOT NULL, id_dispo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_disp DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, nb_places INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rendez_vous_analyse (id INT AUTO_INCREMENT NOT NULL, disponibilite_analyse_id INT NOT NULL, id_rdv VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, id_patient VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, id_disponibilite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_rdv DATE NOT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_988D1C397D348EDE (disponibilite_analyse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_analyse (id INT AUTO_INCREMENT NOT NULL, id_type_analyse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE detail_analyse_analyse ADD CONSTRAINT FK_32BE54CD1EFE06BF FOREIGN KEY (analyse_id) REFERENCES analyse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_analyse_analyse ADD CONSTRAINT FK_32BE54CDA5E4B669 FOREIGN KEY (detail_analyse_id) REFERENCES detail_analyse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_analyse_type_analyse ADD CONSTRAINT FK_D4163F4E3FDD09A FOREIGN KEY (type_analyse_id) REFERENCES type_analyse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_analyse_type_analyse ADD CONSTRAINT FK_D4163F4EA5E4B669 FOREIGN KEY (detail_analyse_id) REFERENCES detail_analyse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendez_vous_analyse ADD CONSTRAINT FK_988D1C397D348EDE FOREIGN KEY (disponibilite_analyse_id) REFERENCES disponibilite_analyse (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
