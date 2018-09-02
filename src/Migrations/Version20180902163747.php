<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180902163747 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE time_capsule_fragment (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, time_capsule_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(1000) NOT NULL, INDEX IDX_AB1BB788F675F31B (author_id), INDEX IDX_AB1BB788F9DD2804 (time_capsule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE time_capsule_fragment ADD CONSTRAINT FK_AB1BB788F675F31B FOREIGN KEY (author_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE time_capsule_fragment ADD CONSTRAINT FK_AB1BB788F9DD2804 FOREIGN KEY (time_capsule_id) REFERENCES time_capsule (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE time_capsule_fragment');
    }
}
