<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825145551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE members DROP FOREIGN KEY FK_45A0D2FFA6EAEB7A');
        $this->addSql('DROP INDEX IDX_45A0D2FFA6EAEB7A ON members');
        $this->addSql('ALTER TABLE members CHANGE zones_id zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE members ADD CONSTRAINT FK_45A0D2FF9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zones (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_45A0D2FF9F2C3FAB ON members (zone_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE members DROP FOREIGN KEY FK_45A0D2FF9F2C3FAB');
        $this->addSql('DROP INDEX IDX_45A0D2FF9F2C3FAB ON members');
        $this->addSql('ALTER TABLE members CHANGE zone_id zones_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE members ADD CONSTRAINT FK_45A0D2FFA6EAEB7A FOREIGN KEY (zones_id) REFERENCES zones (id)');
        $this->addSql('CREATE INDEX IDX_45A0D2FFA6EAEB7A ON members (zones_id)');
    }
}
