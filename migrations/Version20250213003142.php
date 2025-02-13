<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250213003142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formulario (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, paternal_name VARCHAR(50) NOT NULL, maternal_name VARCHAR(50) NOT NULL, street VARCHAR(46) NOT NULL, phone VARCHAR(10) NOT NULL, rfc VARCHAR(13) NOT NULL, state VARCHAR(50) NOT NULL, municipality VARCHAR(50) NOT NULL, postal_code VARCHAR(5) NOT NULL, company_name VARCHAR(100) NOT NULL, company_number VARCHAR(45) NOT NULL, images_ine VARCHAR(255) NOT NULL, images_street VARCHAR(255) NOT NULL, images_nomina VARCHAR(255) NOT NULL, requested_amount NUMERIC(10, 2) NOT NULL, bank VARCHAR(45) NOT NULL, interbank VARCHAR(18) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company CHANGE status status TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE customer ADD name VARCHAR(45) NOT NULL, ADD company_number VARCHAR(45) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE formulario');
        $this->addSql('ALTER TABLE customer DROP name, DROP company_number');
        $this->addSql('ALTER TABLE company CHANGE status status VARCHAR(1) NOT NULL');
    }
}
