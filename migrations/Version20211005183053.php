<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005183053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE custome_counter (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, url VARCHAR(300) NOT NULL, name VARCHAR(300) NOT NULL, text_first VARCHAR(300) DEFAULT NULL, text_last VARCHAR(300) DEFAULT NULL, like_count VARCHAR(300) DEFAULT \'0\' NOT NULL, date_time VARCHAR(300) NOT NULL, UNIQUE INDEX UNIQ_EBA7D82DF47645AE (url), INDEX IDX_EBA7D82DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(50) NOT NULL, user_name VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64924A232CF (user_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE custome_counter ADD CONSTRAINT FK_EBA7D82DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custome_counter DROP FOREIGN KEY FK_EBA7D82DA76ED395');
        $this->addSql('DROP TABLE custome_counter');
        $this->addSql('DROP TABLE user');
    }
}
