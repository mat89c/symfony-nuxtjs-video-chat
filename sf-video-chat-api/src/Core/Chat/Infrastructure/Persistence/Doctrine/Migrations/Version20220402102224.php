<?php

declare(strict_types=1);

namespace App\Core\Chat\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220402102224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chat (id VARBINARY(255) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, chat_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat_message (id VARBINARY(255) NOT NULL COMMENT \'(DC2Type:uuid)\', chat_id VARBINARY(255) NOT NULL COMMENT \'(DC2Type:uuid)\', content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', author_id VARBINARY(255) NOT NULL COMMENT \'(DC2Type:uuid)\', author_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE chat_message');
    }
}
