<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208123849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT NOT NULL, id_medecin_id INT NOT NULL, id_salle_id INT NOT NULL, id_operation INT NOT NULL, type_operation VARCHAR(255) NOT NULL, date_operation DATE NOT NULL, duree TIME NOT NULL, commentaire LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_1981A66DCE0312AE (id_patient_id), UNIQUE INDEX UNIQ_1981A66DA1799A53 (id_medecin_id), INDEX IDX_1981A66D8CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DCE0312AE FOREIGN KEY (id_patient_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DA1799A53 FOREIGN KEY (id_medecin_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66DCE0312AE');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66DA1799A53');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D8CEBACA0');
        $this->addSql('DROP TABLE operation');
    }
}
