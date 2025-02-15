<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250209122231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4B264D3C5');
        $this->addSql('DROP INDEX IDX_166FDEC4B264D3C5 ON bureau');
        $this->addSql('ALTER TABLE bureau DROP id_bureau_id');
        $this->addSql('ALTER TABLE consultation ADD id_bureau_id INT DEFAULT NULL, ADD id_reservation_id INT DEFAULT NULL, ADD id_patient_id INT DEFAULT NULL, ADD id_medecin_id INT DEFAULT NULL, DROP id_bureau, DROP id_reservation, DROP id_patient, DROP id_medecin, CHANGE note note LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6B264D3C5 FOREIGN KEY (id_bureau_id) REFERENCES bureau (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A685542AE1 FOREIGN KEY (id_reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6CE0312AE FOREIGN KEY (id_patient_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6A1799A53 FOREIGN KEY (id_medecin_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_964685A6B264D3C5 ON consultation (id_bureau_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_964685A685542AE1 ON consultation (id_reservation_id)');
        $this->addSql('CREATE INDEX IDX_964685A6CE0312AE ON consultation (id_patient_id)');
        $this->addSql('CREATE INDEX IDX_964685A6A1799A53 ON consultation (id_medecin_id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495585542AE1');
        $this->addSql('DROP INDEX UNIQ_42C8495585542AE1 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP id_reservation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bureau ADD id_bureau_id INT NOT NULL');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4B264D3C5 FOREIGN KEY (id_bureau_id) REFERENCES consultation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_166FDEC4B264D3C5 ON bureau (id_bureau_id)');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6B264D3C5');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A685542AE1');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6CE0312AE');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6A1799A53');
        $this->addSql('DROP INDEX IDX_964685A6B264D3C5 ON consultation');
        $this->addSql('DROP INDEX UNIQ_964685A685542AE1 ON consultation');
        $this->addSql('DROP INDEX IDX_964685A6CE0312AE ON consultation');
        $this->addSql('DROP INDEX IDX_964685A6A1799A53 ON consultation');
        $this->addSql('ALTER TABLE consultation ADD id_bureau INT NOT NULL, ADD id_reservation INT NOT NULL, ADD id_patient INT NOT NULL, ADD id_medecin INT NOT NULL, DROP id_bureau_id, DROP id_reservation_id, DROP id_patient_id, DROP id_medecin_id, CHANGE note note VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD id_reservation_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495585542AE1 FOREIGN KEY (id_reservation_id) REFERENCES consultation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C8495585542AE1 ON reservation (id_reservation_id)');
    }
}
