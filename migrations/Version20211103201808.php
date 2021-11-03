<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103201808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, value LONGTEXT NOT NULL, is_correct TINYINT(1) NOT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, value LONGTEXT NOT NULL, INDEX IDX_B6F7494E12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_question (quizz_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_3723B55CBA934BCD (quizz_id), INDEX IDX_3723B55C1E27F6BF (question_id), PRIMARY KEY(quizz_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_answer (id INT AUTO_INCREMENT NOT NULL, user_question_id INT NOT NULL, value_id INT NOT NULL, INDEX IDX_BF8F5118B73C3F2A (user_question_id), INDEX IDX_BF8F5118F920BBA2 (value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_question (id INT AUTO_INCREMENT NOT NULL, user_quizz_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_567AAD4E5A1EAFCD (user_quizz_id), INDEX IDX_567AAD4E1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_quizz (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, quizz_id INT DEFAULT NULL, INDEX IDX_9EB56C65A76ED395 (user_id), INDEX IDX_9EB56C65BA934BCD (quizz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE quizz_question ADD CONSTRAINT FK_3723B55CBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_question ADD CONSTRAINT FK_3723B55C1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F5118B73C3F2A FOREIGN KEY (user_question_id) REFERENCES user_question (id)');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F5118F920BBA2 FOREIGN KEY (value_id) REFERENCES answer (id)');
        $this->addSql('ALTER TABLE user_question ADD CONSTRAINT FK_567AAD4E5A1EAFCD FOREIGN KEY (user_quizz_id) REFERENCES user_quizz (id)');
        $this->addSql('ALTER TABLE user_question ADD CONSTRAINT FK_567AAD4E1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE user_quizz ADD CONSTRAINT FK_9EB56C65A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_quizz ADD CONSTRAINT FK_9EB56C65BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_answer DROP FOREIGN KEY FK_BF8F5118F920BBA2');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E12469DE2');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE quizz_question DROP FOREIGN KEY FK_3723B55C1E27F6BF');
        $this->addSql('ALTER TABLE user_question DROP FOREIGN KEY FK_567AAD4E1E27F6BF');
        $this->addSql('ALTER TABLE quizz_question DROP FOREIGN KEY FK_3723B55CBA934BCD');
        $this->addSql('ALTER TABLE user_quizz DROP FOREIGN KEY FK_9EB56C65BA934BCD');
        $this->addSql('ALTER TABLE user_quizz DROP FOREIGN KEY FK_9EB56C65A76ED395');
        $this->addSql('ALTER TABLE user_answer DROP FOREIGN KEY FK_BF8F5118B73C3F2A');
        $this->addSql('ALTER TABLE user_question DROP FOREIGN KEY FK_567AAD4E5A1EAFCD');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE quizz_question');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_answer');
        $this->addSql('DROP TABLE user_question');
        $this->addSql('DROP TABLE user_quizz');
    }
}
