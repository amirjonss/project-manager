<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240820203723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add employee and project table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE employee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employee (id INT NOT NULL, user_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D9F75A1A76ED395 ON employee (user_id)');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, customer_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE9395C3F3 ON project (customer_id)');
        $this->addSql('CREATE TABLE project_employee (project_id INT NOT NULL, employee_id INT NOT NULL, PRIMARY KEY(project_id, employee_id))');
        $this->addSql('CREATE INDEX IDX_60D1FE7A166D1F9C ON project_employee (project_id)');
        $this->addSql('CREATE INDEX IDX_60D1FE7A8C03F15C ON project_employee (employee_id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE9395C3F3 FOREIGN KEY (customer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_employee ADD CONSTRAINT FK_60D1FE7A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_employee ADD CONSTRAINT FK_60D1FE7A8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE employee_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT FK_5D9F75A1A76ED395');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE9395C3F3');
        $this->addSql('ALTER TABLE project_employee DROP CONSTRAINT FK_60D1FE7A166D1F9C');
        $this->addSql('ALTER TABLE project_employee DROP CONSTRAINT FK_60D1FE7A8C03F15C');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_employee');
    }
}
