<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208124717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5C8CEBACA0');
        $this->addSql('DROP TABLE intervention_urgence');
        $this->addSql('DROP INDEX UNIQ_4E977E5C8CEBACA0 ON salle');
        $this->addSql('ALTER TABLE salle DROP id_salle_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_urgence (id INT AUTO_INCREMENT NOT NULL, id_intervention INT NOT NULL, id_patient INT NOT NULL, id_medecin INT NOT NULL, id_salle INT NOT NULL, type_intervention VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_intervention DATE NOT NULL, duree DATE NOT NULL, gravite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, commentaires VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE salle ADD id_salle_id INT NOT NULL');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5C8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES intervention_urgence (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4E977E5C8CEBACA0 ON salle (id_salle_id)');
    }
}
