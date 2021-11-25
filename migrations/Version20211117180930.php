<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117180930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_quizz_result (id INT AUTO_INCREMENT NOT NULL, success TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_quizz ADD result_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_quizz ADD CONSTRAINT FK_9EB56C657A7B643 FOREIGN KEY (result_id) REFERENCES user_quizz_result (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9EB56C657A7B643 ON user_quizz (result_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_quizz DROP FOREIGN KEY FK_9EB56C657A7B643');
        $this->addSql('DROP TABLE user_quizz_result');
        $this->addSql('DROP INDEX UNIQ_9EB56C657A7B643 ON user_quizz');
        $this->addSql('ALTER TABLE user_quizz DROP result_id');
    }
}
