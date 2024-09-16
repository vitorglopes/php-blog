<?php

declare(strict_types=1);

namespace src\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916132747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table users';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NULL,
        email VARCHAR(100) NOT NULL,
        passwd VARCHAR(150) NOT NULL,
        active TINYINT NOT NULL DEFAULT 1,
        last_login DATETIME NULL 
        )");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE users");
    }
}
