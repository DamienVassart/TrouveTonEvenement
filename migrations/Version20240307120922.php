<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307120922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, id_unique VARCHAR(255) DEFAULT NULL, id_fantoir VARCHAR(255) DEFAULT NULL, numero VARCHAR(255) DEFAULT NULL, rep VARCHAR(255) DEFAULT NULL, nom_voie VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, code_insee VARCHAR(255) DEFAULT NULL, nom_commune VARCHAR(255) DEFAULT NULL, code_insee_ancienne_commune VARCHAR(255) DEFAULT NULL, nom_ancienne_commune VARCHAR(255) DEFAULT NULL, x VARCHAR(255) DEFAULT NULL, y VARCHAR(255) DEFAULT NULL, lon VARCHAR(255) DEFAULT NULL, lat VARCHAR(255) DEFAULT NULL, type_position VARCHAR(255) DEFAULT NULL, alias VARCHAR(255) DEFAULT NULL, nom_ld VARCHAR(255) DEFAULT NULL, libelle_acheminement VARCHAR(255) DEFAULT NULL, nom_afnor VARCHAR(255) DEFAULT NULL, source_position VARCHAR(255) DEFAULT NULL, source_nom_voie VARCHAR(255) DEFAULT NULL, certification_commune VARCHAR(255) DEFAULT NULL, cad_parcelles TEXT DEFAULT NULL, FULLTEXT INDEX adresse_index (id_unique), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_evenement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, parent INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, statut_id INT NOT NULL, adresse_id INT DEFAULT NULL, localite_id INT DEFAULT NULL, intitule VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, visuel VARCHAR(255) DEFAULT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, debut_inscriptions DATE NOT NULL, fin_inscriptions DATE NOT NULL, nb_participants_mini INT NOT NULL, nb_participants_maxi INT NOT NULL, tarif_normal DOUBLE PRECISION NOT NULL, tarif_reduit DOUBLE PRECISION DEFAULT NULL, adresse_saisie VARCHAR(200) DEFAULT NULL, INDEX IDX_B26681EBCF5E72D (categorie_id), INDEX IDX_B26681EF6203804 (statut_id), INDEX IDX_B26681E4DE7DC5C (adresse_id), INDEX IDX_B26681E924DD2B5 (localite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localite (id INT AUTO_INCREMENT NOT NULL, insee_code VARCHAR(255) DEFAULT NULL, city_code VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, department_name VARCHAR(255) DEFAULT NULL, department_number VARCHAR(255) DEFAULT NULL, region_name VARCHAR(255) DEFAULT NULL, region_geojson_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, prenom VARCHAR(30) NOT NULL, nom VARCHAR(30) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_D79F6B11B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, statut_id INT NOT NULL, evenement_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_42C84955F6203804 (statut_id), INDEX IDX_42C84955FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_426EF392E7927C74 (email), UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_evenement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_reservation (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(30) NOT NULL, telephone VARCHAR(30) NOT NULL, organisateur TINYINT(1) NOT NULL, favoris JSON DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_evenement (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EF6203804 FOREIGN KEY (statut_id) REFERENCES statut_evenement (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E924DD2B5 FOREIGN KEY (localite_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F6203804 FOREIGN KEY (statut_id) REFERENCES statut_reservation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EBCF5E72D');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EF6203804');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E4DE7DC5C');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E924DD2B5');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11B83297E7');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F6203804');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FD02F13');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE categorie_evenement');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE localite');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE statut_evenement');
        $this->addSql('DROP TABLE statut_reservation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
