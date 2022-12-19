<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221218160430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE new_year_clubs (
        id INT AUTO_INCREMENT NOT NULL,
        email VARCHAR(255) NOT NULL,
        events VARCHAR(255) NOT NULL,
        created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
        updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE new_year_clubs');
    }
}
