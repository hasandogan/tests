<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211002200054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE custome_counter (id INT AUTO_INCREMENT NOT NULL, member_id_id INT NOT NULL, url VARCHAR(300) NOT NULL, UNIQUE INDEX UNIQ_EBA7D82DF47645AE (url), INDEX IDX_EBA7D82D1D650BA4 (member_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE custome_counter ADD CONSTRAINT FK_EBA7D82D1D650BA4 FOREIGN KEY (member_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE custome_counter');
    }
}
