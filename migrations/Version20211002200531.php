<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211002200531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custome_counter DROP FOREIGN KEY FK_EBA7D82D1D650BA4');
        $this->addSql('DROP INDEX IDX_EBA7D82D1D650BA4 ON custome_counter');
        $this->addSql('ALTER TABLE custome_counter CHANGE member_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE custome_counter ADD CONSTRAINT FK_EBA7D82DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EBA7D82DA76ED395 ON custome_counter (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custome_counter DROP FOREIGN KEY FK_EBA7D82DA76ED395');
        $this->addSql('DROP INDEX IDX_EBA7D82DA76ED395 ON custome_counter');
        $this->addSql('ALTER TABLE custome_counter CHANGE user_id member_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE custome_counter ADD CONSTRAINT FK_EBA7D82D1D650BA4 FOREIGN KEY (member_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EBA7D82D1D650BA4 ON custome_counter (member_id_id)');
    }
}
