<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116100530 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE serie_serie_seasons DROP FOREIGN KEY FK_D92C1B90471DD562');
        $this->addSql('DROP TABLE serie_seasons');
        $this->addSql('DROP TABLE serie_serie_seasons');
        $this->addSql('ALTER TABLE serie ADD date_sortie DATETIME NOT NULL, ADD duree VARCHAR(255) NOT NULL, ADD notes VARCHAR(255) NOT NULL, ADD nationalite VARCHAR(255) NOT NULL, ADD limitation INT NOT NULL, ADD url_ba VARCHAR(500) NOT NULL, ADD url_pochette VARCHAR(500) NOT NULL, ADD description VARCHAR(2000) NOT NULL');
        $this->addSql('ALTER TABLE serie_episode ADD episode_number INT NOT NULL, ADD saison_number INT NOT NULL, ADD description VARCHAR(2000) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE serie_seasons (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE serie_serie_seasons (serie_id INT NOT NULL, serie_seasons_id INT NOT NULL, INDEX IDX_D92C1B90D94388BD (serie_id), INDEX IDX_D92C1B90471DD562 (serie_seasons_id), PRIMARY KEY(serie_id, serie_seasons_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE serie_serie_seasons ADD CONSTRAINT FK_D92C1B90471DD562 FOREIGN KEY (serie_seasons_id) REFERENCES serie_seasons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_serie_seasons ADD CONSTRAINT FK_D92C1B90D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie DROP date_sortie, DROP duree, DROP notes, DROP nationalite, DROP limitation, DROP url_ba, DROP url_pochette, DROP description');
        $this->addSql('ALTER TABLE serie_episode DROP episode_number, DROP saison_number, DROP description');
    }
}
