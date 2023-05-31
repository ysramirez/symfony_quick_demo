<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230531222737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empleado ADD oficina_id INT NOT NULL');
        $this->addSql('ALTER TABLE empleado ADD CONSTRAINT FK_D9D9BF528A8639B7 FOREIGN KEY (oficina_id) REFERENCES oficina (id)');
        $this->addSql('CREATE INDEX IDX_D9D9BF528A8639B7 ON empleado (oficina_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empleado DROP FOREIGN KEY FK_D9D9BF528A8639B7');
        $this->addSql('DROP INDEX IDX_D9D9BF528A8639B7 ON empleado');
        $this->addSql('ALTER TABLE empleado DROP oficina_id');
    }
}
