<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231208221243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient CHANGE proteins proteins DOUBLE PRECISION NOT NULL, CHANGE fats fats DOUBLE PRECISION NOT NULL, CHANGE carbohydrates carbohydrates DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD servings INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP servings');
        $this->addSql('ALTER TABLE ingredient CHANGE proteins proteins DOUBLE PRECISION DEFAULT NULL, CHANGE fats fats DOUBLE PRECISION DEFAULT NULL, CHANGE carbohydrates carbohydrates DOUBLE PRECISION DEFAULT NULL');
    }
}
