<?php

declare(strict_types=1);

namespace src\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240922012732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $sql =
            "ALTER TABLE posts 
            ADD COLUMN status ENUM ('draft', 'hidden', 'ok') NOT NULL DEFAULT 'draft' ";
        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        $this->addSql("ALTER TABLE posts DROP COLUMN status ");
    }
}
