<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615174617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE img_prestation ADD description VARCHAR(1500) NOT NULL');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADC06A9F55');
        $this->addSql('DROP INDEX IDX_51C88FADC06A9F55 ON prestation');
        $this->addSql('ALTER TABLE prestation DROP img_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE img_prestation DROP description');
        $this->addSql('ALTER TABLE prestation ADD img_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADC06A9F55 FOREIGN KEY (img_id) REFERENCES img (id)');
        $this->addSql('CREATE INDEX IDX_51C88FADC06A9F55 ON prestation (img_id)');
    }
}
