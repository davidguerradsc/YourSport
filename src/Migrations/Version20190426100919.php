<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190426100919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, membre_id INT NOT NULL, sport_id INT NOT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, departement VARCHAR(100) NOT NULL, lieu VARCHAR(120) NOT NULL, adresse VARCHAR(150) NOT NULL, details VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, heure TIME NOT NULL, INDEX IDX_B26681E6A99F74A (membre_id), INDEX IDX_B26681EAC78BCF8 (sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_membre (evenement_id INT NOT NULL, membre_id INT NOT NULL, INDEX IDX_45412BABFD02F13 (evenement_id), INDEX IDX_45412BAB6A99F74A (membre_id), PRIMARY KEY(evenement_id, membre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(80) NOT NULL, prenom VARCHAR(80) NOT NULL, pseudo VARCHAR(80) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(64) NOT NULL, date_de_naissance DATETIME NOT NULL, ville VARCHAR(100) NOT NULL, departement VARCHAR(100) NOT NULL, date_inscription DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sports (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(120) NOT NULL, slug VARCHAR(120) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sports (id)');
        $this->addSql('ALTER TABLE evenement_membre ADD CONSTRAINT FK_45412BABFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_membre ADD CONSTRAINT FK_45412BAB6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement_membre DROP FOREIGN KEY FK_45412BABFD02F13');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E6A99F74A');
        $this->addSql('ALTER TABLE evenement_membre DROP FOREIGN KEY FK_45412BAB6A99F74A');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EAC78BCF8');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE evenement_membre');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE sports');
    }
}
