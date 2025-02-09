<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208105315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attributions_dons (id INT AUTO_INCREMENT NOT NULL, don_id_id INT NOT NULL, demande_id_id INT NOT NULL, beneficiaire_id_id INT NOT NULL, attribution_id INT NOT NULL, date_attribution DATE NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_5CC8BCF8717A92C1 (don_id_id), UNIQUE INDEX UNIQ_5CC8BCF8899A1D7E (demande_id_id), INDEX IDX_5CC8BCF85EB92B42 (beneficiaire_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attributions_dons ADD CONSTRAINT FK_5CC8BCF8717A92C1 FOREIGN KEY (don_id_id) REFERENCES dons (id)');
        $this->addSql('ALTER TABLE attributions_dons ADD CONSTRAINT FK_5CC8BCF8899A1D7E FOREIGN KEY (demande_id_id) REFERENCES demandes_dons (id)');
        $this->addSql('ALTER TABLE attributions_dons ADD CONSTRAINT FK_5CC8BCF85EB92B42 FOREIGN KEY (beneficiaire_id_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attributions_dons DROP FOREIGN KEY FK_5CC8BCF8717A92C1');
        $this->addSql('ALTER TABLE attributions_dons DROP FOREIGN KEY FK_5CC8BCF8899A1D7E');
        $this->addSql('ALTER TABLE attributions_dons DROP FOREIGN KEY FK_5CC8BCF85EB92B42');
        $this->addSql('DROP TABLE attributions_dons');
    }
}
