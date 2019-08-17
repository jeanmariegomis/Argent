<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190817134904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, user_emetteur_id INT NOT NULL, user_recepteur_id INT NOT NULL, client_emetteur VARCHAR(255) NOT NULL, telephone_emetteur VARCHAR(255) NOT NULL, nci_emetteur VARCHAR(255) NOT NULL, date_envoi DATETIME NOT NULL, code VARCHAR(255) NOT NULL, montant BIGINT NOT NULL, frais BIGINT NOT NULL, client_recepteur VARCHAR(255) NOT NULL, telephone_recepteur VARCHAR(255) NOT NULL, nci_recepteur VARCHAR(255) NOT NULL, datereception DATETIME DEFAULT NULL, commission_emetteur BIGINT DEFAULT NULL, commission_receptteur BIGINT DEFAULT NULL, commission_wari BIGINT DEFAULT NULL, taxes_etat BIGINT DEFAULT NULL, INDEX IDX_723705D1D0F2E719 (user_emetteur_id), INDEX IDX_723705D1BB85042F (user_recepteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1D0F2E719 FOREIGN KEY (user_emetteur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1BB85042F FOREIGN KEY (user_recepteur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE transaction');
    }
}
