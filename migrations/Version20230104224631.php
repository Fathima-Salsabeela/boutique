<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104224631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal INT NOT NULL, suject VARCHAR(255) NOT NULL, point INT NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bebe (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, couleur VARCHAR(255) NOT NULL, taille VARCHAR(255) NOT NULL, collection VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, prix INT NOT NULL, stock INT NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL, question LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfants (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, couleur VARCHAR(255) NOT NULL, taille VARCHAR(255) NOT NULL, collection VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, prix INT NOT NULL, stock INT NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE femme (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, couleur VARCHAR(255) NOT NULL, taille VARCHAR(255) NOT NULL, collection VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, prix INT NOT NULL, stock INT NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE homme (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, couleur VARCHAR(255) NOT NULL, taille VARCHAR(255) NOT NULL, collection VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, prix INT NOT NULL, stock INT NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD femme_id INT NOT NULL, ADD homme_id INT NOT NULL, ADD enfants_id INT NOT NULL, ADD bebe_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DEA18A17C FOREIGN KEY (femme_id) REFERENCES femme (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D5BE2EC00 FOREIGN KEY (homme_id) REFERENCES homme (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA586286C FOREIGN KEY (enfants_id) REFERENCES enfants (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DAF762365 FOREIGN KEY (bebe_id) REFERENCES bebe (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DEA18A17C ON commande (femme_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D5BE2EC00 ON commande (homme_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA586286C ON commande (enfants_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DAF762365 ON commande (bebe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DAF762365');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA586286C');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEA18A17C');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D5BE2EC00');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE bebe');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE enfants');
        $this->addSql('DROP TABLE femme');
        $this->addSql('DROP TABLE homme');
        $this->addSql('DROP INDEX IDX_6EEAA67DEA18A17C ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D5BE2EC00 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DA586286C ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DAF762365 ON commande');
        $this->addSql('ALTER TABLE commande DROP femme_id, DROP homme_id, DROP enfants_id, DROP bebe_id');
    }
}
