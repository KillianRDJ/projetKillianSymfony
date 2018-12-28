<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181227130409 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE films_genre (films_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_6A87B186939610EE (films_id), INDEX IDX_6A87B1864296D31F (genre_id), PRIMARY KEY(films_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE films_genre ADD CONSTRAINT FK_6A87B186939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_genre ADD CONSTRAINT FK_6A87B1864296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE films_genre DROP FOREIGN KEY FK_6A87B1864296D31F');
        $this->addSql('DROP TABLE films_genre');
        $this->addSql('DROP TABLE genre');
    }
}
