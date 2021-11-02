<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211102165953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizz_answer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, value LONGTEXT NOT NULL, is_correct TINYINT(1) NOT NULL, INDEX IDX_80226C341E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_catgory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_question (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, value LONGTEXT NOT NULL, INDEX IDX_3723B55C12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quizz_answer ADD CONSTRAINT FK_80226C341E27F6BF FOREIGN KEY (question_id) REFERENCES quizz_question (id)');
        $this->addSql('ALTER TABLE quizz_question ADD CONSTRAINT FK_3723B55C12469DE2 FOREIGN KEY (category_id) REFERENCES quizz_catgory (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz_question DROP FOREIGN KEY FK_3723B55C12469DE2');
        $this->addSql('ALTER TABLE quizz_answer DROP FOREIGN KEY FK_80226C341E27F6BF');
        $this->addSql('DROP TABLE quizz_answer');
        $this->addSql('DROP TABLE quizz_catgory');
        $this->addSql('DROP TABLE quizz_question');
        $this->addSql('DROP TABLE `user`');
    }
}
