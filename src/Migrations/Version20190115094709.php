<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190115094709 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_genre (serie_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_4B5C076CD94388BD (serie_id), INDEX IDX_4B5C076C4296D31F (genre_id), PRIMARY KEY(serie_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_acteur (serie_id INT NOT NULL, acteur_id INT NOT NULL, INDEX IDX_1D50880BD94388BD (serie_id), INDEX IDX_1D50880BDA6F574A (acteur_id), PRIMARY KEY(serie_id, acteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_realisateur (serie_id INT NOT NULL, realisateur_id INT NOT NULL, INDEX IDX_40AF0CADD94388BD (serie_id), INDEX IDX_40AF0CADF1D8422E (realisateur_id), PRIMARY KEY(serie_id, realisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_serie_episode (serie_id INT NOT NULL, serie_episode_id INT NOT NULL, INDEX IDX_B0723756D94388BD (serie_id), INDEX IDX_B072375667DD28A4 (serie_episode_id), PRIMARY KEY(serie_id, serie_episode_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_serie_seasons (serie_id INT NOT NULL, serie_seasons_id INT NOT NULL, INDEX IDX_D92C1B90D94388BD (serie_id), INDEX IDX_D92C1B90471DD562 (serie_seasons_id), PRIMARY KEY(serie_id, serie_seasons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_episode (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_seasons (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE serie_genre ADD CONSTRAINT FK_4B5C076CD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_genre ADD CONSTRAINT FK_4B5C076C4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_acteur ADD CONSTRAINT FK_1D50880BD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_acteur ADD CONSTRAINT FK_1D50880BDA6F574A FOREIGN KEY (acteur_id) REFERENCES acteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_realisateur ADD CONSTRAINT FK_40AF0CADD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_realisateur ADD CONSTRAINT FK_40AF0CADF1D8422E FOREIGN KEY (realisateur_id) REFERENCES realisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_serie_episode ADD CONSTRAINT FK_B0723756D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_serie_episode ADD CONSTRAINT FK_B072375667DD28A4 FOREIGN KEY (serie_episode_id) REFERENCES serie_episode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_serie_seasons ADD CONSTRAINT FK_D92C1B90D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_serie_seasons ADD CONSTRAINT FK_D92C1B90471DD562 FOREIGN KEY (serie_seasons_id) REFERENCES serie_seasons (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE serie_genre DROP FOREIGN KEY FK_4B5C076CD94388BD');
        $this->addSql('ALTER TABLE serie_acteur DROP FOREIGN KEY FK_1D50880BD94388BD');
        $this->addSql('ALTER TABLE serie_realisateur DROP FOREIGN KEY FK_40AF0CADD94388BD');
        $this->addSql('ALTER TABLE serie_serie_episode DROP FOREIGN KEY FK_B0723756D94388BD');
        $this->addSql('ALTER TABLE serie_serie_seasons DROP FOREIGN KEY FK_D92C1B90D94388BD');
        $this->addSql('ALTER TABLE serie_serie_episode DROP FOREIGN KEY FK_B072375667DD28A4');
        $this->addSql('ALTER TABLE serie_serie_seasons DROP FOREIGN KEY FK_D92C1B90471DD562');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE serie_genre');
        $this->addSql('DROP TABLE serie_acteur');
        $this->addSql('DROP TABLE serie_realisateur');
        $this->addSql('DROP TABLE serie_serie_episode');
        $this->addSql('DROP TABLE serie_serie_seasons');
        $this->addSql('DROP TABLE serie_episode');
        $this->addSql('DROP TABLE serie_seasons');
    }
}
