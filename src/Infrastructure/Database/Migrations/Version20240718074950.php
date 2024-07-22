<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240718074950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Created the order_status table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE order_status (
                                id INT NOT NULL,
                                status_id INT NOT NULL,
                                is_delivery BOOLEAN NOT NULL,
                                is_express BOOLEAN NOT NULL,
                                code VARCHAR(60) NOT NULL,
                                title VARCHAR(60) NOT NULL,
                                sub_title TEXT NOT NULL,
                                description TEXT NOT NULL,
                                ico_type TEXT NOT NULL,
                                PRIMARY KEY(id))'
        );
        $this->addSql('CREATE INDEX status_order_type_idx ON order_status (is_delivery, is_express)');
        $this->addSql('COMMENT ON COLUMN order_status.sub_title IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN order_status.description IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN order_status.ico_type IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE order_status');
    }
}
