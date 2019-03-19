<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190319125427 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE perler_brands (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE perler_colors ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE perler_colors ADD CONSTRAINT FK_368487B644F5D008 FOREIGN KEY (brand_id) REFERENCES perler_brands (id)');
        $this->addSql('CREATE INDEX IDX_368487B644F5D008 ON perler_colors (brand_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE perler_colors DROP FOREIGN KEY FK_368487B644F5D008');
        $this->addSql('DROP TABLE perler_brands');
        $this->addSql('DROP INDEX IDX_368487B644F5D008 ON perler_colors');
        $this->addSql('ALTER TABLE perler_colors DROP brand_id');
    }
}
