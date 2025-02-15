<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208103628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dons DROP FOREIGN KEY FK_E4F955FA17AF7FD0');
        $this->addSql('CREATE TABLE demandes_dons (id INT AUTO_INCREMENT NOT NULL, patient_id_id INT NOT NULL, demande_id INT NOT NULL, type_besoin VARCHAR(255) NOT NULL, details LONGTEXT NOT NULL, date_demande DATE NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_3F6C6385EA724598 (patient_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demandes_dons ADD CONSTRAINT FK_3F6C6385EA724598 FOREIGN KEY (patient_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE attribution_don DROP FOREIGN KEY FK_541DF7614D69E58E');
        $this->addSql('DROP TABLE attribution_don');
        $this->addSql('DROP INDEX IDX_E4F955FA17AF7FD0 ON dons');
        $this->addSql('ALTER TABLE dons DROP attribution_don_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribution_don (id INT AUTO_INCREMENT NOT NULL, beneficiare_id_id INT NOT NULL, attribution_id INT NOT NULL, type_besoin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, details LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_attribution DATE NOT NULL, statut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, priorite INT NOT NULL, INDEX IDX_541DF7614D69E58E (beneficiare_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE attribution_don ADD CONSTRAINT FK_541DF7614D69E58E FOREIGN KEY (beneficiare_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE demandes_dons DROP FOREIGN KEY FK_3F6C6385EA724598');
        $this->addSql('DROP TABLE demandes_dons');
        $this->addSql('ALTER TABLE dons ADD attribution_don_id INT NOT NULL');
        $this->addSql('ALTER TABLE dons ADD CONSTRAINT FK_E4F955FA17AF7FD0 FOREIGN KEY (attribution_don_id) REFERENCES attribution_don (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E4F955FA17AF7FD0 ON dons (attribution_don_id)');
    }
}
