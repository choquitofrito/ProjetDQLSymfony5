<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200319155950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_mm (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_mm_exemplaire_mm (client_mm_id INT NOT NULL, exemplaire_mm_id INT NOT NULL, INDEX IDX_7D51D8F754A1EBAA (client_mm_id), INDEX IDX_7D51D8F76C7B44BC (exemplaire_mm_id), PRIMARY KEY(client_mm_id, exemplaire_mm_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exemplaire_mm (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_mm_exemplaire_mm ADD CONSTRAINT FK_7D51D8F754A1EBAA FOREIGN KEY (client_mm_id) REFERENCES client_mm (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_mm_exemplaire_mm ADD CONSTRAINT FK_7D51D8F76C7B44BC FOREIGN KEY (exemplaire_mm_id) REFERENCES exemplaire_mm (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('ALTER TABLE adresse CHANGE numero numero INT NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE emprunt CHANGE date_emprunt date_emprunt DATE NOT NULL, CHANGE date_retour date_retour DATE NOT NULL, CHANGE commentaires commentaires LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE exemplaire CHANGE etat etat LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE livre DROP isbn, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE date_publication date_publication DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client_mm_exemplaire_mm DROP FOREIGN KEY FK_7D51D8F754A1EBAA');
        $this->addSql('ALTER TABLE client_mm_exemplaire_mm DROP FOREIGN KEY FK_7D51D8F76C7B44BC');
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nationalite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE client_mm');
        $this->addSql('DROP TABLE client_mm_exemplaire_mm');
        $this->addSql('DROP TABLE exemplaire_mm');
        $this->addSql('ALTER TABLE adresse CHANGE numero numero INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(300) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE emprunt CHANGE date_emprunt date_emprunt DATETIME NOT NULL, CHANGE date_retour date_retour DATETIME DEFAULT NULL, CHANGE commentaires commentaires VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE exemplaire CHANGE etat etat VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE livre ADD isbn VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE titre titre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prix prix NUMERIC(8, 2) DEFAULT NULL, CHANGE description description VARCHAR(400) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_publication date_publication DATETIME DEFAULT NULL');
    }
}
