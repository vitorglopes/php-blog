<?php

declare(strict_types=1);

namespace src\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916141422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table posts';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE posts (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT NOT NULL,
        category_id INT NOT NULL,
        views INT NOT NULL DEFAULT 0,
        title VARCHAR(1000) NOT NULL,
        subtitle TEXT NULL,
        content LONGTEXT NULL,
        registered_at DATETIME NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (category_id) REFERENCES categories(id),
        INDEX index_views (views),
        INDEX index_user_id (user_id),
        INDEX index_category_id (category_id),
        INDEX index_registered (registered_at)
        )");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE posts");
    }
}
