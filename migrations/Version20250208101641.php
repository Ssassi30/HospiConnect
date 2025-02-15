<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208101641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `analyse` (id INT AUTO_INCREMENT NOT NULL, id_analyse VARCHAR(255) NOT NULL, id_patient VARCHAR(255) NOT NULL, id_personnel VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, date_prelevement DATE NOT NULL, id_rendezvous VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribution_don (id INT AUTO_INCREMENT NOT NULL, beneficiare_id_id INT NOT NULL, attribution_id INT NOT NULL, type_besoin VARCHAR(255) NOT NULL, details LONGTEXT NOT NULL, date_attribution DATE NOT NULL, statut VARCHAR(255) NOT NULL, priorite INT NOT NULL, INDEX IDX_541DF7614D69E58E (beneficiare_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bureau (id INT AUTO_INCREMENT NOT NULL, id_bureau_id INT NOT NULL, disponibilite TINYINT(1) NOT NULL, localisation VARCHAR(255) NOT NULL, INDEX IDX_166FDEC4B264D3C5 (id_bureau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, id_bureau INT NOT NULL, id_consultation INT NOT NULL, id_reservation INT NOT NULL, type_consultation VARCHAR(255) NOT NULL, date_consultation DATE NOT NULL, note VARCHAR(255) NOT NULL, id_patient INT NOT NULL, id_medecin INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_analyse (id INT AUTO_INCREMENT NOT NULL, resultat VARCHAR(255) NOT NULL, date_resultat DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_analyse_analyse (detail_analyse_id INT NOT NULL, analyse_id INT NOT NULL, INDEX IDX_32BE54CDA5E4B669 (detail_analyse_id), INDEX IDX_32BE54CD1EFE06BF (analyse_id), PRIMARY KEY(detail_analyse_id, analyse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_analyse_type_analyse (detail_analyse_id INT NOT NULL, type_analyse_id INT NOT NULL, INDEX IDX_D4163F4EA5E4B669 (detail_analyse_id), INDEX IDX_D4163F4E3FDD09A (type_analyse_id), PRIMARY KEY(detail_analyse_id, type_analyse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disponibilite_analyse (id INT AUTO_INCREMENT NOT NULL, id_dispo VARCHAR(255) NOT NULL, date_disp DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, nb_places INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dons (id INT AUTO_INCREMENT NOT NULL, donateur_id_id INT NOT NULL, attribution_don_id INT NOT NULL, don_id INT NOT NULL, type_don VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, date_don DATE NOT NULL, disponibilite TINYINT(1) NOT NULL, INDEX IDX_E4F955FAFDFECE7 (donateur_id_id), INDEX IDX_E4F955FA17AF7FD0 (attribution_don_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_urgence (id INT AUTO_INCREMENT NOT NULL, id_intervention INT NOT NULL, id_patient INT NOT NULL, id_medecin INT NOT NULL, id_salle INT NOT NULL, type_intervention VARCHAR(255) NOT NULL, date_intervention DATE NOT NULL, duree DATE NOT NULL, gravite VARCHAR(255) NOT NULL, commentaires VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, id_materiel INT NOT NULL, nom VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, quantite INT NOT NULL, emplacement VARCHAR(255) NOT NULL, date_ajout DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mouvement_stock (id INT AUTO_INCREMENT NOT NULL, id_materiel_id INT NOT NULL, id_mouvement INT NOT NULL, type_mouvement VARCHAR(255) NOT NULL, quantite INT NOT NULL, date_mouvement DATE NOT NULL, motif LONGTEXT NOT NULL, INDEX IDX_61E2C8EBE9AC758 (id_materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT NOT NULL, id_operation INT NOT NULL, id_patient INT NOT NULL, id_medecin INT NOT NULL, date_operation DATE NOT NULL, duree DATE NOT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_1981A66D8CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT NOT NULL, id_salle_id INT NOT NULL, id_rendezvous INT NOT NULL, id_medecin INT NOT NULL, date_rendezvous DATE NOT NULL, heure_rendezvous TIME NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_65E8AA0ACE0312AE (id_patient_id), INDEX IDX_65E8AA0A8CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous_analyse (id INT AUTO_INCREMENT NOT NULL, disponibilite_analyse_id INT NOT NULL, id_rdv VARCHAR(255) NOT NULL, id_patient VARCHAR(255) NOT NULL, id_disponibilite VARCHAR(255) NOT NULL, date_rdv DATE NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_988D1C397D348EDE (disponibilite_analyse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, id_reservation_id INT NOT NULL, date_reservation DATE NOT NULL, nom VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_42C8495585542AE1 (id_reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT NOT NULL, nom_salle VARCHAR(255) NOT NULL, type_salle VARCHAR(255) NOT NULL, disponibilite TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_4E977E5C8CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_analyse (id INT AUTO_INCREMENT NOT NULL, id_type_analyse VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, date_n DATE NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, date_c DATE NOT NULL, statut_compte VARCHAR(20) NOT NULL, empreinte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribution_don ADD CONSTRAINT FK_541DF7614D69E58E FOREIGN KEY (beneficiare_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4B264D3C5 FOREIGN KEY (id_bureau_id) REFERENCES consultation (id)');
        $this->addSql('ALTER TABLE detail_analyse_analyse ADD CONSTRAINT FK_32BE54CDA5E4B669 FOREIGN KEY (detail_analyse_id) REFERENCES detail_analyse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_analyse_analyse ADD CONSTRAINT FK_32BE54CD1EFE06BF FOREIGN KEY (analyse_id) REFERENCES `analyse` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_analyse_type_analyse ADD CONSTRAINT FK_D4163F4EA5E4B669 FOREIGN KEY (detail_analyse_id) REFERENCES detail_analyse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_analyse_type_analyse ADD CONSTRAINT FK_D4163F4E3FDD09A FOREIGN KEY (type_analyse_id) REFERENCES type_analyse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dons ADD CONSTRAINT FK_E4F955FAFDFECE7 FOREIGN KEY (donateur_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE dons ADD CONSTRAINT FK_E4F955FA17AF7FD0 FOREIGN KEY (attribution_don_id) REFERENCES attribution_don (id)');
        $this->addSql('ALTER TABLE mouvement_stock ADD CONSTRAINT FK_61E2C8EBE9AC758 FOREIGN KEY (id_materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0ACE0312AE FOREIGN KEY (id_patient_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE rendez_vous_analyse ADD CONSTRAINT FK_988D1C397D348EDE FOREIGN KEY (disponibilite_analyse_id) REFERENCES disponibilite_analyse (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495585542AE1 FOREIGN KEY (id_reservation_id) REFERENCES consultation (id)');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5C8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES intervention_urgence (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribution_don DROP FOREIGN KEY FK_541DF7614D69E58E');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4B264D3C5');
        $this->addSql('ALTER TABLE detail_analyse_analyse DROP FOREIGN KEY FK_32BE54CDA5E4B669');
        $this->addSql('ALTER TABLE detail_analyse_analyse DROP FOREIGN KEY FK_32BE54CD1EFE06BF');
        $this->addSql('ALTER TABLE detail_analyse_type_analyse DROP FOREIGN KEY FK_D4163F4EA5E4B669');
        $this->addSql('ALTER TABLE detail_analyse_type_analyse DROP FOREIGN KEY FK_D4163F4E3FDD09A');
        $this->addSql('ALTER TABLE dons DROP FOREIGN KEY FK_E4F955FAFDFECE7');
        $this->addSql('ALTER TABLE dons DROP FOREIGN KEY FK_E4F955FA17AF7FD0');
        $this->addSql('ALTER TABLE mouvement_stock DROP FOREIGN KEY FK_61E2C8EBE9AC758');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D8CEBACA0');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0ACE0312AE');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A8CEBACA0');
        $this->addSql('ALTER TABLE rendez_vous_analyse DROP FOREIGN KEY FK_988D1C397D348EDE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495585542AE1');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5C8CEBACA0');
        $this->addSql('DROP TABLE `analyse`');
        $this->addSql('DROP TABLE attribution_don');
        $this->addSql('DROP TABLE bureau');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE detail_analyse');
        $this->addSql('DROP TABLE detail_analyse_analyse');
        $this->addSql('DROP TABLE detail_analyse_type_analyse');
        $this->addSql('DROP TABLE disponibilite_analyse');
        $this->addSql('DROP TABLE dons');
        $this->addSql('DROP TABLE intervention_urgence');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE mouvement_stock');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE rendez_vous_analyse');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE type_analyse');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
