<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190413211424 extends AbstractMigration
{
	public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE movement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE supplier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE item (id INT NOT NULL, name TEXT NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, date_added TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE movement (id INT NOT NULL, item_id INT NOT NULL, supplier_id INT DEFAULT NULL, direction INT NOT NULL, date_when TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F4DD95F7126F525E ON movement (item_id)');
        $this->addSql('CREATE INDEX IDX_F4DD95F72ADD6D8C ON movement (supplier_id)');
        $this->addSql('CREATE TABLE supplier (id INT NOT NULL, name TEXT NOT NULL, date_registration TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_supply TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE movement ADD CONSTRAINT FK_F4DD95F7126F525E FOREIGN KEY (item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movement ADD CONSTRAINT FK_F4DD95F72ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE movement DROP CONSTRAINT FK_F4DD95F7126F525E');
        $this->addSql('ALTER TABLE movement DROP CONSTRAINT FK_F4DD95F72ADD6D8C');
        $this->addSql('DROP SEQUENCE item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE movement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE supplier_id_seq CASCADE');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE movement');
        $this->addSql('DROP TABLE supplier');
    }
}
