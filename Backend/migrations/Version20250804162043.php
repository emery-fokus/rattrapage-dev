<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250804162043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poketype ADD type1 VARCHAR(50) NOT NULL, ADD type2 VARCHAR(50) DEFAULT NULL, DROP type_1, DROP type_2');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poketype ADD type_2 VARCHAR(50) NOT NULL, DROP type2, CHANGE type1 type_1 VARCHAR(50) NOT NULL');
    }
}
