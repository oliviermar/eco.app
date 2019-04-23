<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407143435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE address ADD user_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN address.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES eco_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('ALTER TABLE eco_user DROP CONSTRAINT fk_a841cb0ef5b7af75');
        $this->addSql('DROP INDEX idx_a841cb0ef5b7af75');
        $this->addSql('ALTER TABLE eco_user DROP address_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE address DROP CONSTRAINT FK_D4E6F81A76ED395');
        $this->addSql('DROP INDEX IDX_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE address DROP user_id');
        $this->addSql('ALTER TABLE eco_user ADD address_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN eco_user.address_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE eco_user ADD CONSTRAINT fk_a841cb0ef5b7af75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_a841cb0ef5b7af75 ON eco_user (address_id)');
    }
}
