<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181227140852 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE films_realisateur (films_id INT NOT NULL, realisateur_id INT NOT NULL, INDEX IDX_A02DDBB2939610EE (films_id), INDEX IDX_A02DDBB2F1D8422E (realisateur_id), PRIMARY KEY(films_id, realisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisateur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE films_realisateur ADD CONSTRAINT FK_A02DDBB2939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_realisateur ADD CONSTRAINT FK_A02DDBB2F1D8422E FOREIGN KEY (realisateur_id) REFERENCES realisateur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE films_realisateur DROP FOREIGN KEY FK_A02DDBB2F1D8422E');
        $this->addSql('DROP TABLE films_realisateur');
        $this->addSql('DROP TABLE realisateur');
    }
}
