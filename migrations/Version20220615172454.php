<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615172454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE img_prestation (img_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_BF21F830C06A9F55 (img_id), INDEX IDX_BF21F8309E45C554 (prestation_id), PRIMARY KEY(img_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE img_prestation ADD CONSTRAINT FK_BF21F830C06A9F55 FOREIGN KEY (img_id) REFERENCES img (id)');
        $this->addSql('ALTER TABLE img_prestation ADD CONSTRAINT FK_BF21F8309E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE img_prestation');
    }
}
