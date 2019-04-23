<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190331110338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE address (id UUID NOT NULL, street VARCHAR(255) NOT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, street_number INT DEFAULT NULL, address_complement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN address.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE eco_user (id UUID NOT NULL, address_id UUID DEFAULT NULL, username VARCHAR(255) NOT NULL, roles TEXT NOT NULL, password TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A841CB0EF5B7AF75 ON eco_user (address_id)');
        $this->addSql('COMMENT ON COLUMN eco_user.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN eco_user.address_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN eco_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE offer (id UUID NOT NULL, address_id UUID DEFAULT NULL, user_id UUID DEFAULT NULL, title VARCHAR(50) NOT NULL, description TEXT NOT NULL, quantity VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29D6873EF5B7AF75 ON offer (address_id)');
        $this->addSql('CREATE INDEX IDX_29D6873EA76ED395 ON offer (user_id)');
        $this->addSql('COMMENT ON COLUMN offer.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN offer.address_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN offer.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE offer_tag (offer_id UUID NOT NULL, tag_id UUID NOT NULL, PRIMARY KEY(offer_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_2FBCD61B53C674EE ON offer_tag (offer_id)');
        $this->addSql('CREATE INDEX IDX_2FBCD61BBAD26311 ON offer_tag (tag_id)');
        $this->addSql('COMMENT ON COLUMN offer_tag.offer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN offer_tag.tag_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE tag (id UUID NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tag.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE eco_user ADD CONSTRAINT FK_A841CB0EF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EA76ED395 FOREIGN KEY (user_id) REFERENCES eco_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer_tag ADD CONSTRAINT FK_2FBCD61B53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer_tag ADD CONSTRAINT FK_2FBCD61BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE eco_user DROP CONSTRAINT FK_A841CB0EF5B7AF75');
        $this->addSql('ALTER TABLE offer DROP CONSTRAINT FK_29D6873EF5B7AF75');
        $this->addSql('ALTER TABLE offer DROP CONSTRAINT FK_29D6873EA76ED395');
        $this->addSql('ALTER TABLE offer_tag DROP CONSTRAINT FK_2FBCD61B53C674EE');
        $this->addSql('ALTER TABLE offer_tag DROP CONSTRAINT FK_2FBCD61BBAD26311');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE eco_user');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_tag');
        $this->addSql('DROP TABLE tag');
    }
}
