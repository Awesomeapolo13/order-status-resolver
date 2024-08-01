<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240722144957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fix mistake with data types for content columns';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE order_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE order_status ALTER sub_title TYPE JSON USING sub_title::json');
        $this->addSql('ALTER TABLE order_status ALTER description TYPE JSON USING description::json');
        $this->addSql('ALTER TABLE order_status ALTER ico_type TYPE JSON USING ico_type::json');
        $this->addSql('COMMENT ON COLUMN order_status.sub_title IS NULL');
        $this->addSql('COMMENT ON COLUMN order_status.description IS NULL');
        $this->addSql('COMMENT ON COLUMN order_status.ico_type IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE order_status_id_seq CASCADE');
        $this->addSql('ALTER TABLE order_status ALTER sub_title TYPE TEXT USING sub_title::text');
        $this->addSql('ALTER TABLE order_status ALTER description TYPE TEXT USING description::text');
        $this->addSql('ALTER TABLE order_status ALTER ico_type TYPE TEXT USING ico_type::text');
        $this->addSql('COMMENT ON COLUMN order_status.sub_title IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN order_status.description IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN order_status.ico_type IS \'(DC2Type:array)\'');
    }
}
