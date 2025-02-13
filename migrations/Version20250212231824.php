<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250212231824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, user_auth_id INT DEFAULT NULL, requested_amount VARCHAR(100) NOT NULL, status TINYINT(1) NOT NULL, application_date DATETIME NOT NULL, resolution_date DATETIME NOT NULL, bank VARCHAR(100) NOT NULL, interbank VARCHAR(100) NOT NULL, notes VARCHAR(150) NOT NULL, INDEX IDX_A45BDDC19395C3F3 (customer_id), INDEX IDX_A45BDDC1D88F9F96 (user_auth_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, create_date DATETIME NOT NULL, upda_date DATETIME NOT NULL, rfc VARCHAR(45) NOT NULL, company_name VARCHAR(45) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, paternal_suername VARCHAR(50) NOT NULL, maternal_surname VARCHAR(50) NOT NULL, street VARCHAR(100) NOT NULL, state VARCHAR(100) NOT NULL, municipality VARCHAR(100) NOT NULL, postal_code VARCHAR(100) NOT NULL, number VARCHAR(100) NOT NULL, crete_date DATETIME NOT NULL, update_date DATETIME NOT NULL, status TINYINT(1) NOT NULL, name VARCHAR(45) NOT NULL, company_number VARCHAR(45) NOT NULL, INDEX IDX_81398E09979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, application_id INT DEFAULT NULL, document_name VARCHAR(100) NOT NULL, document_type VARCHAR(100) NOT NULL, file VARCHAR(100) NOT NULL, status TINYINT(1) NOT NULL, create_date DATETIME NOT NULL, update_date DATETIME NOT NULL, INDEX IDX_D8698A763E030ACD (application_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formulario (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, paternal_name VARCHAR(50) NOT NULL, maternal_name VARCHAR(50) NOT NULL, street VARCHAR(46) NOT NULL, phone VARCHAR(10) NOT NULL, rfc VARCHAR(13) NOT NULL, state VARCHAR(50) NOT NULL, municipality VARCHAR(50) NOT NULL, postal_code VARCHAR(5) NOT NULL, company_name VARCHAR(100) NOT NULL, company_number VARCHAR(45) NOT NULL, images_ine VARCHAR(255) NOT NULL, images_street VARCHAR(255) NOT NULL, images_nomina VARCHAR(255) NOT NULL, requested_amount NUMERIC(10, 2) NOT NULL, bank VARCHAR(45) NOT NULL, interbank VARCHAR(18) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, paternal_surname VARCHAR(50) NOT NULL, maternal_surname VARCHAR(50) NOT NULL, number_phone VARCHAR(45) NOT NULL, rol VARCHAR(45) NOT NULL, password VARCHAR(45) NOT NULL, email VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC19395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1D88F9F96 FOREIGN KEY (user_auth_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A763E030ACD FOREIGN KEY (application_id) REFERENCES application (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC19395C3F3');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1D88F9F96');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09979B1AD6');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A763E030ACD');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE formulario');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
