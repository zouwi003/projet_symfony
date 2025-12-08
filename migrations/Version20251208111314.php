<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251208111314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve ADD id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ECA105F779F37AE5 ON eleve (id_user_id)');
        $this->addSql('ALTER TABLE enseignant ADD id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA179F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81A72FA179F37AE5 ON enseignant (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F779F37AE5');
        $this->addSql('DROP INDEX UNIQ_ECA105F779F37AE5 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP id_user_id');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA179F37AE5');
        $this->addSql('DROP INDEX UNIQ_81A72FA179F37AE5 ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP id_user_id');
    }
}
