<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107090753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_avis (commande_id INT NOT NULL, avis_id INT NOT NULL, INDEX IDX_E4FDAA1382EA2E54 (commande_id), INDEX IDX_E4FDAA13197E709F (avis_id), PRIMARY KEY(commande_id, avis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_avis ADD CONSTRAINT FK_E4FDAA1382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_avis ADD CONSTRAINT FK_E4FDAA13197E709F FOREIGN KEY (avis_id) REFERENCES avis (id) ON DELETE CASCADE');
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
        $this->addSql('ALTER TABLE commande_avis DROP FOREIGN KEY FK_E4FDAA1382EA2E54');
        $this->addSql('ALTER TABLE commande_avis DROP FOREIGN KEY FK_E4FDAA13197E709F');
        $this->addSql('DROP TABLE commande_avis');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEA18A17C');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D5BE2EC00');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA586286C');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DAF762365');
        $this->addSql('DROP INDEX IDX_6EEAA67DEA18A17C ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D5BE2EC00 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DA586286C ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DAF762365 ON commande');
    }
}
