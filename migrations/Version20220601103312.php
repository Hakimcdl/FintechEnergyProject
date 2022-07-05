<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601103312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638BCE02308');
        $this->addSql('DROP INDEX UNIQ_4C62E638BCE02308 ON contact');
        $this->addSql('ALTER TABLE contact CHANGE user_contact_id_id user_contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63840C6E3A6 FOREIGN KEY (user_contact_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E63840C6E3A6 ON contact (user_contact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63840C6E3A6');
        $this->addSql('DROP INDEX UNIQ_4C62E63840C6E3A6 ON contact');
        $this->addSql('ALTER TABLE contact CHANGE user_contact_id user_contact_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638BCE02308 FOREIGN KEY (user_contact_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638BCE02308 ON contact (user_contact_id_id)');
    }
}
