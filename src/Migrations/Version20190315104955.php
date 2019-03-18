<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190315104955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE palette (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, width INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE palette_perler_colors (palette_id INT NOT NULL, perler_colors_id INT NOT NULL, INDEX IDX_8EE304EC908BC74 (palette_id), INDEX IDX_8EE304EC39850E11 (perler_colors_id), PRIMARY KEY(palette_id, perler_colors_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE palette_perler_colors ADD CONSTRAINT FK_8EE304EC908BC74 FOREIGN KEY (palette_id) REFERENCES palette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE palette_perler_colors ADD CONSTRAINT FK_8EE304EC39850E11 FOREIGN KEY (perler_colors_id) REFERENCES perler_colors (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE palette_perler_colors DROP FOREIGN KEY FK_8EE304EC908BC74');
        $this->addSql('DROP TABLE palette');
        $this->addSql('DROP TABLE palette_perler_colors');
    }
}
