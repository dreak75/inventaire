<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128044607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_stuffs (option_id INT NOT NULL, stuffs_id INT NOT NULL, INDEX IDX_9966918FA7C41D6F (option_id), INDEX IDX_9966918F9138F6A2 (stuffs_id), PRIMARY KEY(option_id, stuffs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE option_stuffs ADD CONSTRAINT FK_9966918FA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE option_stuffs ADD CONSTRAINT FK_9966918F9138F6A2 FOREIGN KEY (stuffs_id) REFERENCES stuffs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stuffs DROP container');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE option_stuffs DROP FOREIGN KEY FK_9966918FA7C41D6F');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE option_stuffs');
        $this->addSql('ALTER TABLE stuffs ADD container INT NOT NULL');
    }
}
