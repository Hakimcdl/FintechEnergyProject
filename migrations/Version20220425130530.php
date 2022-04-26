<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220425130530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment_prestation (appointment_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_2881BD67E5B533F9 (appointment_id), INDEX IDX_2881BD679E45C554 (prestation_id), PRIMARY KEY(appointment_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment_prestation ADD CONSTRAINT FK_2881BD67E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_prestation ADD CONSTRAINT FK_2881BD679E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE prestation_appointment');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prestation_appointment (prestation_id INT NOT NULL, appointment_id INT NOT NULL, INDEX IDX_AC8425759E45C554 (prestation_id), INDEX IDX_AC842575E5B533F9 (appointment_id), PRIMARY KEY(prestation_id, appointment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE prestation_appointment ADD CONSTRAINT FK_AC8425759E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_appointment ADD CONSTRAINT FK_AC842575E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE appointment_prestation');
    }
}
