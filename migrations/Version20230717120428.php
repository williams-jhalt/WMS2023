<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717120428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE item_tracker');
        $this->addSql('DROP TABLE migration_versions');
        $this->addSql('DROP TABLE picker_journal');
        $this->addSql('ALTER TABLE carton CHANGE ship_height ship_height DOUBLE PRECISION DEFAULT NULL, CHANGE ship_length ship_length DOUBLE PRECISION DEFAULT NULL, CHANGE ship_width ship_width DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE product_attachment CHANGE product_id product_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_tracker (id INT AUTO_INCREMENT NOT NULL, manifest_id VARCHAR(45) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, item VARCHAR(45) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, serial_number VARCHAR(45) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE migration_versions (version VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(version)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE picker_journal (id INT AUTO_INCREMENT NOT NULL, manifest_id VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, picker VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, page_count INT DEFAULT 1, created_on DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE carton CHANGE ship_height ship_height DOUBLE PRECISION DEFAULT \'1\', CHANGE ship_length ship_length DOUBLE PRECISION DEFAULT \'1\', CHANGE ship_width ship_width DOUBLE PRECISION DEFAULT \'1\'');
        $this->addSql('ALTER TABLE product_attachment CHANGE product_id product_id INT NOT NULL');
    }
}
