<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208125528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mouvements_stock (id INT AUTO_INCREMENT NOT NULL, id_materiel_id INT NOT NULL, id_personnel_id INT NOT NULL, id_mouvement INT NOT NULL, qunatite INT NOT NULL, date_mouvement DATE NOT NULL, motif VARCHAR(255) NOT NULL, INDEX IDX_B3536722E9AC758 (id_materiel_id), INDEX IDX_B35367223FD1E507 (id_personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mouvements_stock ADD CONSTRAINT FK_B3536722E9AC758 FOREIGN KEY (id_materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE mouvements_stock ADD CONSTRAINT FK_B35367223FD1E507 FOREIGN KEY (id_personnel_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvements_stock DROP FOREIGN KEY FK_B3536722E9AC758');
        $this->addSql('ALTER TABLE mouvements_stock DROP FOREIGN KEY FK_B35367223FD1E507');
        $this->addSql('DROP TABLE mouvements_stock');
    }
}
