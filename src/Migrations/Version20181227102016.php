<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181227102016 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre_films (genre_id INT NOT NULL, films_id INT NOT NULL, INDEX IDX_73EAD5944296D31F (genre_id), INDEX IDX_73EAD594939610EE (films_id), PRIMARY KEY(genre_id, films_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE genre_films ADD CONSTRAINT FK_73EAD5944296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_films ADD CONSTRAINT FK_73EAD594939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genre_films DROP FOREIGN KEY FK_73EAD5944296D31F');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_films');
    }
}
