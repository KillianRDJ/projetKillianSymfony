<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181227140049 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE films_acteur (films_id INT NOT NULL, acteur_id INT NOT NULL, INDEX IDX_5DAE58DB939610EE (films_id), INDEX IDX_5DAE58DBDA6F574A (acteur_id), PRIMARY KEY(films_id, acteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acteur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE films_acteur ADD CONSTRAINT FK_5DAE58DB939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_acteur ADD CONSTRAINT FK_5DAE58DBDA6F574A FOREIGN KEY (acteur_id) REFERENCES acteur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE films_acteur DROP FOREIGN KEY FK_5DAE58DBDA6F574A');
        $this->addSql('DROP TABLE films_acteur');
        $this->addSql('DROP TABLE acteur');
    }
}
