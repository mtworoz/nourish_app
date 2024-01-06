<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105000734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, ebook_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_F981B52E76E71D49 (ebook_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapter_recipe (chapter_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_81D656BC579F4768 (chapter_id), INDEX IDX_81D656BC59D8A214 (recipe_id), PRIMARY KEY(chapter_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ebook (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52E76E71D49 FOREIGN KEY (ebook_id) REFERENCES ebook (id)');
        $this->addSql('ALTER TABLE chapter_recipe ADD CONSTRAINT FK_81D656BC579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chapter_recipe ADD CONSTRAINT FK_81D656BC59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52E76E71D49');
        $this->addSql('ALTER TABLE chapter_recipe DROP FOREIGN KEY FK_81D656BC579F4768');
        $this->addSql('ALTER TABLE chapter_recipe DROP FOREIGN KEY FK_81D656BC59D8A214');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE chapter_recipe');
        $this->addSql('DROP TABLE ebook');
    }
}
