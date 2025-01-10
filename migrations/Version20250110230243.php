<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250110230243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commune (id INT NOT NULL, id_eveche_id INT DEFAULT NULL, id_pays_id INT DEFAULT NULL, nom_francais VARCHAR(255) NOT NULL, nom_breton VARCHAR(255) DEFAULT NULL, nom_gallo VARCHAR(255) DEFAULT NULL, habitants INT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, code INT NOT NULL, INDEX IDX_E2E2D1EE71A3CD5C (id_eveche_id), INDEX IDX_E2E2D1EE7879EB34 (id_pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eveche (id INT NOT NULL, nom_francais VARCHAR(255) NOT NULL, nom_breton VARCHAR(255) DEFAULT NULL, nom_gallo VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT NOT NULL, nom_francais VARCHAR(255) NOT NULL, nom_breton VARCHAR(255) DEFAULT NULL, nom_gallo VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EE71A3CD5C FOREIGN KEY (id_eveche_id) REFERENCES eveche (id)');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EE7879EB34 FOREIGN KEY (id_pays_id) REFERENCES pays (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EE71A3CD5C');
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EE7879EB34');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE eveche');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE user');
    }
}
