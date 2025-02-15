<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208122419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE analyse (id INT AUTO_INCREMENT NOT NULL, rdv_id INT NOT NULL, patient_id INT NOT NULL, personnel_id INT NOT NULL, id_analyse INT NOT NULL, etat VARCHAR(255) NOT NULL, date_prelevement DATE NOT NULL, UNIQUE INDEX UNIQ_351B0C7E4CCE3F86 (rdv_id), INDEX IDX_351B0C7E6B899279 (patient_id), INDEX IDX_351B0C7E1C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_analyse (id INT AUTO_INCREMENT NOT NULL, analyse_id INT NOT NULL, type_analyse_id INT NOT NULL, resultat VARCHAR(255) NOT NULL, date_resultat DATE NOT NULL, INDEX IDX_52D48CAB1EFE06BF (analyse_id), INDEX IDX_52D48CAB3FDD09A (type_analyse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disponibilite_analyse (id INT AUTO_INCREMENT NOT NULL, id_dispo INT NOT NULL, date_dispo DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, nb_places INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous_analyse (id INT AUTO_INCREMENT NOT NULL, disponibilite_id INT NOT NULL, patient_id INT NOT NULL, id_rdv INT NOT NULL, date_rdv DATE NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_988D1C392B9D6493 (disponibilite_id), INDEX IDX_988D1C396B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_analyse (id INT AUTO_INCREMENT NOT NULL, id_type_analyse INT NOT NULL, libelle VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE analyse ADD CONSTRAINT FK_351B0C7E4CCE3F86 FOREIGN KEY (rdv_id) REFERENCES rendez_vous_analyse (id)');
        $this->addSql('ALTER TABLE analyse ADD CONSTRAINT FK_351B0C7E6B899279 FOREIGN KEY (patient_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE analyse ADD CONSTRAINT FK_351B0C7E1C109075 FOREIGN KEY (personnel_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE detail_analyse ADD CONSTRAINT FK_52D48CAB1EFE06BF FOREIGN KEY (analyse_id) REFERENCES analyse (id)');
        $this->addSql('ALTER TABLE detail_analyse ADD CONSTRAINT FK_52D48CAB3FDD09A FOREIGN KEY (type_analyse_id) REFERENCES type_analyse (id)');
        $this->addSql('ALTER TABLE rendez_vous_analyse ADD CONSTRAINT FK_988D1C392B9D6493 FOREIGN KEY (disponibilite_id) REFERENCES disponibilite_analyse (id)');
        $this->addSql('ALTER TABLE rendez_vous_analyse ADD CONSTRAINT FK_988D1C396B899279 FOREIGN KEY (patient_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE analyse DROP FOREIGN KEY FK_351B0C7E4CCE3F86');
        $this->addSql('ALTER TABLE analyse DROP FOREIGN KEY FK_351B0C7E6B899279');
        $this->addSql('ALTER TABLE analyse DROP FOREIGN KEY FK_351B0C7E1C109075');
        $this->addSql('ALTER TABLE detail_analyse DROP FOREIGN KEY FK_52D48CAB1EFE06BF');
        $this->addSql('ALTER TABLE detail_analyse DROP FOREIGN KEY FK_52D48CAB3FDD09A');
        $this->addSql('ALTER TABLE rendez_vous_analyse DROP FOREIGN KEY FK_988D1C392B9D6493');
        $this->addSql('ALTER TABLE rendez_vous_analyse DROP FOREIGN KEY FK_988D1C396B899279');
        $this->addSql('DROP TABLE analyse');
        $this->addSql('DROP TABLE detail_analyse');
        $this->addSql('DROP TABLE disponibilite_analyse');
        $this->addSql('DROP TABLE rendez_vous_analyse');
        $this->addSql('DROP TABLE type_analyse');
    }
}
