<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251208110911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseignant ADD matiere_id_id INT NOT NULL, ADD classe_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1F3E43022 FOREIGN KEY (matiere_id_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA13633CA6F FOREIGN KEY (classe_id_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA1F3E43022 ON enseignant (matiere_id_id)');
        $this->addSql('CREATE INDEX IDX_81A72FA13633CA6F ON enseignant (classe_id_id)');
        $this->addSql('ALTER TABLE matiere ADD note_id INT NOT NULL');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A26ED0855 FOREIGN KEY (note_id) REFERENCES note (id)');
        $this->addSql('CREATE INDEX IDX_9014574A26ED0855 ON matiere (note_id)');
        $this->addSql('ALTER TABLE note ADD enseignant_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1454E6585E FOREIGN KEY (enseignant_id_id) REFERENCES enseignant (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA1454E6585E ON note (enseignant_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1F3E43022');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA13633CA6F');
        $this->addSql('DROP INDEX IDX_81A72FA1F3E43022 ON enseignant');
        $this->addSql('DROP INDEX IDX_81A72FA13633CA6F ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP matiere_id_id, DROP classe_id_id');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A26ED0855');
        $this->addSql('DROP INDEX IDX_9014574A26ED0855 ON matiere');
        $this->addSql('ALTER TABLE matiere DROP note_id');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1454E6585E');
        $this->addSql('DROP INDEX IDX_CFBDFA1454E6585E ON note');
        $this->addSql('ALTER TABLE note DROP enseignant_id_id');
    }
}
