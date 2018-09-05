<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180905153813 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE time_capsule_user (time_capsule_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B52754FCF9DD2804 (time_capsule_id), INDEX IDX_B52754FCA76ED395 (user_id), PRIMARY KEY(time_capsule_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE time_capsule_user ADD CONSTRAINT FK_B52754FCF9DD2804 FOREIGN KEY (time_capsule_id) REFERENCES time_capsule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE time_capsule_user ADD CONSTRAINT FK_B52754FCA76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE time_capsule_user');
    }
}
