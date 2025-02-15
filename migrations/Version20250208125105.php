<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208125105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_urgence (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT NOT NULL, id_salle_id INT NOT NULL, id_intervention INT NOT NULL, type_intervention VARCHAR(255) NOT NULL, date_intervention DATE NOT NULL, garvite VARCHAR(255) NOT NULL, commentaires LONGTEXT NOT NULL, INDEX IDX_38931FA8CE0312AE (id_patient_id), INDEX IDX_38931FA88CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_urgence_user (intervention_urgence_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_70518F9E157605B0 (intervention_urgence_id), INDEX IDX_70518F9EA76ED395 (user_id), PRIMARY KEY(intervention_urgence_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervention_urgence ADD CONSTRAINT FK_38931FA8CE0312AE FOREIGN KEY (id_patient_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE intervention_urgence ADD CONSTRAINT FK_38931FA88CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE intervention_urgence_user ADD CONSTRAINT FK_70518F9E157605B0 FOREIGN KEY (intervention_urgence_id) REFERENCES intervention_urgence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_urgence_user ADD CONSTRAINT FK_70518F9EA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention_urgence DROP FOREIGN KEY FK_38931FA8CE0312AE');
        $this->addSql('ALTER TABLE intervention_urgence DROP FOREIGN KEY FK_38931FA88CEBACA0');
        $this->addSql('ALTER TABLE intervention_urgence_user DROP FOREIGN KEY FK_70518F9E157605B0');
        $this->addSql('ALTER TABLE intervention_urgence_user DROP FOREIGN KEY FK_70518F9EA76ED395');
        $this->addSql('DROP TABLE intervention_urgence');
        $this->addSql('DROP TABLE intervention_urgence_user');
    }
}
