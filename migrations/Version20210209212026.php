<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209212026 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE containers ADD filename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE stuffs_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE stuffs_option DROP FOREIGN KEY FK_9966918F9138F6A2');
        $this->addSql('ALTER TABLE stuffs_option DROP FOREIGN KEY FK_9966918FA7C41D6F');
        $this->addSql('ALTER TABLE stuffs_option ADD PRIMARY KEY (stuffs_id, option_id)');
        $this->addSql('DROP INDEX idx_9966918f9138f6a2 ON stuffs_option');
        $this->addSql('CREATE INDEX IDX_4FF530D59138F6A2 ON stuffs_option (stuffs_id)');
        $this->addSql('DROP INDEX idx_9966918fa7c41d6f ON stuffs_option');
        $this->addSql('CREATE INDEX IDX_4FF530D5A7C41D6F ON stuffs_option (option_id)');
        $this->addSql('ALTER TABLE stuffs_option ADD CONSTRAINT FK_9966918F9138F6A2 FOREIGN KEY (stuffs_id) REFERENCES stuffs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stuffs_option ADD CONSTRAINT FK_9966918FA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE containers DROP filename');
        $this->addSql('ALTER TABLE stuffs_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE stuffs_option DROP FOREIGN KEY FK_4FF530D59138F6A2');
        $this->addSql('ALTER TABLE stuffs_option DROP FOREIGN KEY FK_4FF530D5A7C41D6F');
        $this->addSql('ALTER TABLE stuffs_option ADD PRIMARY KEY (option_id, stuffs_id)');
        $this->addSql('DROP INDEX idx_4ff530d59138f6a2 ON stuffs_option');
        $this->addSql('CREATE INDEX IDX_9966918F9138F6A2 ON stuffs_option (stuffs_id)');
        $this->addSql('DROP INDEX idx_4ff530d5a7c41d6f ON stuffs_option');
        $this->addSql('CREATE INDEX IDX_9966918FA7C41D6F ON stuffs_option (option_id)');
        $this->addSql('ALTER TABLE stuffs_option ADD CONSTRAINT FK_4FF530D59138F6A2 FOREIGN KEY (stuffs_id) REFERENCES stuffs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stuffs_option ADD CONSTRAINT FK_4FF530D5A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }
}
