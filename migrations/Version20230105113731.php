<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105113731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
