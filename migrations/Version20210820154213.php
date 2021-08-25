<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820154213 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zones DROP FOREIGN KEY FK_85CAB168E7877946');
        $this->addSql('ALTER TABLE zones ADD CONSTRAINT FK_85CAB168E7877946 FOREIGN KEY (coordinator_id) REFERENCES Coordinators (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zones DROP FOREIGN KEY FK_85CAB168E7877946');
        $this->addSql('ALTER TABLE zones ADD CONSTRAINT FK_85CAB168E7877946 FOREIGN KEY (coordinator_id) REFERENCES coordinators (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
