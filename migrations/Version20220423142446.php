<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220423142446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zamowienie (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, numer_trackingowy VARCHAR(255) NOT NULL, nadawca INT NOT NULL, odbiorca INT NOT NULL, zleceniodawca INT NOT NULL, telefon VARCHAR(255) NOT NULL, sub_nadawca TINYINT(1) NOT NULL, sub_odbiorca TINYINT(1) NOT NULL, sub_zleceniodawca TINYINT(1) NOT NULL, INDEX IDX_3ABAEDC16BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zamowienie ADD CONSTRAINT FK_3ABAEDC16BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('INSERT INTO status (status) VALUES ("utworzone"), ("w transporcie"), ("w realizacji"), ("anulowane"), ("zakończone")');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zamowienie DROP FOREIGN KEY FK_3ABAEDC16BF700BD');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE zamowienie');
    }
}
