<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210123131158 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stuffs ADD CONSTRAINT FK_DA369358BC21F742 FOREIGN KEY (container_id) REFERENCES containers (id)');
        $this->addSql('CREATE INDEX IDX_DA369358BC21F742 ON stuffs (container_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stuffs DROP FOREIGN KEY FK_DA369358BC21F742');
        $this->addSql('DROP INDEX IDX_DA369358BC21F742 ON stuffs');
    }
}
