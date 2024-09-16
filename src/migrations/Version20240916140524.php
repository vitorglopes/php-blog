<?php

declare(strict_types=1);

namespace src\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916140524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table categories';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE categories (
        id INT PRIMARY KEY AUTO_INCREMENT,
        description VARCHAR(255) NOT NULL
        )");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE categories");
    }
}
