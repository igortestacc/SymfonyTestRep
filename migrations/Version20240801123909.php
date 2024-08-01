<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240801123909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE work_info_work_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(255) NOT NULL, age INT NOT NULL, date_birth TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT fk_clients_work_info');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE work_info');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE work_info_work_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client (user_id SERIAL NOT NULL, work_info_id INT DEFAULT NULL, fullname VARCHAR(128) NOT NULL, age INT NOT NULL, PRIMARY KEY(user_id))');
        $this->addSql('CREATE INDEX IDX_C7440455884079DA ON client (work_info_id)');
        $this->addSql('CREATE TABLE work_info (work_id SERIAL NOT NULL, work_position VARCHAR(128) NOT NULL, startedat DATE NOT NULL, PRIMARY KEY(work_id))');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT fk_clients_work_info FOREIGN KEY (work_info_id) REFERENCES work_info (work_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "user"');
    }
}
