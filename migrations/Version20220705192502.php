<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705192502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, residencyaccessupdate_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, postal_adress VARCHAR(255) NOT NULL, postal_code INT NOT NULL, surface INT NOT NULL, mail VARCHAR(255) NOT NULL, phone INT NOT NULL, request_date DATETIME NOT NULL, call_back_request DATE NOT NULL, entreprise TINYINT(1) DEFAULT NULL, note VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, company_name VARCHAR(255) DEFAULT NULL, siret INT DEFAULT NULL, INDEX IDX_FE38F844E33F9DA7 (residencyaccessupdate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment_prestation (appointment_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_2881BD67E5B533F9 (appointment_id), INDEX IDX_2881BD679E45C554 (prestation_id), PRIMARY KEY(appointment_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, user_contact_id INT DEFAULT NULL, mail VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, phone INT NOT NULL, executed TINYINT(1) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4C62E63840C6E3A6 (user_contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE img (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE img_prestation (img_id INT NOT NULL, prestation_id INT NOT NULL, description VARCHAR(1500) NOT NULL, INDEX IDX_BF21F830C06A9F55 (img_id), INDEX IDX_BF21F8309E45C554 (prestation_id), PRIMARY KEY(img_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(180) NOT NULL, date_creation DATETIME NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_51C88FAD2B36786B (title), INDEX IDX_51C88FADA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE residency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844E33F9DA7 FOREIGN KEY (residencyaccessupdate_id) REFERENCES residency (id)');
        $this->addSql('ALTER TABLE appointment_prestation ADD CONSTRAINT FK_2881BD67E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_prestation ADD CONSTRAINT FK_2881BD679E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63840C6E3A6 FOREIGN KEY (user_contact_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE img_prestation ADD CONSTRAINT FK_BF21F830C06A9F55 FOREIGN KEY (img_id) REFERENCES img (id)');
        $this->addSql('ALTER TABLE img_prestation ADD CONSTRAINT FK_BF21F8309E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment_prestation DROP FOREIGN KEY FK_2881BD67E5B533F9');
        $this->addSql('ALTER TABLE img_prestation DROP FOREIGN KEY FK_BF21F830C06A9F55');
        $this->addSql('ALTER TABLE appointment_prestation DROP FOREIGN KEY FK_2881BD679E45C554');
        $this->addSql('ALTER TABLE img_prestation DROP FOREIGN KEY FK_BF21F8309E45C554');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844E33F9DA7');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63840C6E3A6');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADA76ED395');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE appointment_prestation');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE img');
        $this->addSql('DROP TABLE img_prestation');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE residency');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
