<?php

declare(strict_types=1);

namespace src\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916143742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table comments';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE comments (
        id INT PRIMARY KEY AUTO_INCREMENT,
        ref_comment_id INT NOT NULL DEFAULT 0,
        post_id INT NOT NULL,
        user_id INT NOT NULL,
        content TEXT NULL,
        registered_at DATETIME NOT NULL,
        FOREIGN KEY (post_id) REFERENCES posts(id),
        FOREIGN KEY (user_id) REFERENCES users(id),
        INDEX index_ref_comment (ref_comment_id),
        INDEX index_post_id (post_id),
        INDEX index_user_id (user_id)
        )");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE comments");
    }
}
