<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251208195851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY `FK_ECA105F726ED0855`');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY `FK_ECA105F7F6B192E`');
        $this->addSql('DROP INDEX IDX_ECA105F726ED0855 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F7F6B192E ON eleve');
        $this->addSql('ALTER TABLE eleve ADD classe_id INT NOT NULL, DROP id_classe_id, DROP note_id');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F78F5EA509 ON eleve (classe_id)');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY `FK_81A72FA13633CA6F`');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY `FK_81A72FA1F3E43022`');
        $this->addSql('DROP INDEX IDX_81A72FA13633CA6F ON enseignant');
        $this->addSql('DROP INDEX IDX_81A72FA1F3E43022 ON enseignant');
        $this->addSql('ALTER TABLE enseignant CHANGE matiere_id_id matiere_id INT NOT NULL, CHANGE classe_id_id classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA18F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA1F46CD258 ON enseignant (matiere_id)');
        $this->addSql('CREATE INDEX IDX_81A72FA18F5EA509 ON enseignant (classe_id)');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY `FK_9014574A26ED0855`');
        $this->addSql('DROP INDEX IDX_9014574A26ED0855 ON matiere');
        $this->addSql('ALTER TABLE matiere DROP note_id');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY `FK_CFBDFA1454E6585E`');
        $this->addSql('DROP INDEX IDX_CFBDFA1454E6585E ON note');
        $this->addSql('ALTER TABLE note ADD matiere_id INT NOT NULL, ADD enseignant_id INT NOT NULL, CHANGE enseignant_id_id eleve_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14A6CC7B2 ON note (eleve_id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14F46CD258 ON note (matiere_id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14E455FCC0 ON note (enseignant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('DROP INDEX IDX_ECA105F78F5EA509 ON eleve');
        $this->addSql('ALTER TABLE eleve ADD note_id INT NOT NULL, CHANGE classe_id id_classe_id INT NOT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT `FK_ECA105F726ED0855` FOREIGN KEY (note_id) REFERENCES note (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT `FK_ECA105F7F6B192E` FOREIGN KEY (id_classe_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_ECA105F726ED0855 ON eleve (note_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7F6B192E ON eleve (id_classe_id)');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1F46CD258');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA18F5EA509');
        $this->addSql('DROP INDEX IDX_81A72FA1F46CD258 ON enseignant');
        $this->addSql('DROP INDEX IDX_81A72FA18F5EA509 ON enseignant');
        $this->addSql('ALTER TABLE enseignant CHANGE matiere_id matiere_id_id INT NOT NULL, CHANGE classe_id classe_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT `FK_81A72FA13633CA6F` FOREIGN KEY (classe_id_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT `FK_81A72FA1F3E43022` FOREIGN KEY (matiere_id_id) REFERENCES matiere (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_81A72FA13633CA6F ON enseignant (classe_id_id)');
        $this->addSql('CREATE INDEX IDX_81A72FA1F3E43022 ON enseignant (matiere_id_id)');
        $this->addSql('ALTER TABLE matiere ADD note_id INT NOT NULL');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT `FK_9014574A26ED0855` FOREIGN KEY (note_id) REFERENCES note (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9014574A26ED0855 ON matiere (note_id)');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14A6CC7B2');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14F46CD258');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14E455FCC0');
        $this->addSql('DROP INDEX IDX_CFBDFA14A6CC7B2 ON note');
        $this->addSql('DROP INDEX IDX_CFBDFA14F46CD258 ON note');
        $this->addSql('DROP INDEX IDX_CFBDFA14E455FCC0 ON note');
        $this->addSql('ALTER TABLE note ADD enseignant_id_id INT NOT NULL, DROP eleve_id, DROP matiere_id, DROP enseignant_id');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT `FK_CFBDFA1454E6585E` FOREIGN KEY (enseignant_id_id) REFERENCES enseignant (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CFBDFA1454E6585E ON note (enseignant_id_id)');
    }
}
