<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220305160652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom (id INT AUTO_INCREMENT NOT NULL, class_id VARCHAR(255) NOT NULL, class_name VARCHAR(255) NOT NULL, class_status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, grade_id INT NOT NULL, grade_result DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade_student (grade_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_4D6E3DD1FE19A1A8 (grade_id), INDEX IDX_4D6E3DD1CB944F1A (student_id), PRIMARY KEY(grade_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, classroom_id INT DEFAULT NULL, student_id VARCHAR(255) NOT NULL, student_name VARCHAR(255) NOT NULL, student_dob DATE NOT NULL, student_email VARCHAR(255) NOT NULL, student_address VARCHAR(255) NOT NULL, student_image VARCHAR(255) NOT NULL, INDEX IDX_B723AF336278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, grade_id INT DEFAULT NULL, subject_id VARCHAR(255) NOT NULL, subject_name VARCHAR(255) NOT NULL, subject_teacher VARCHAR(255) NOT NULL, INDEX IDX_FBCE3E7AFE19A1A8 (grade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE grade_student ADD CONSTRAINT FK_4D6E3DD1FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grade_student ADD CONSTRAINT FK_4D6E3DD1CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF336278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7AFE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF336278D5A8');
        $this->addSql('ALTER TABLE grade_student DROP FOREIGN KEY FK_4D6E3DD1FE19A1A8');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7AFE19A1A8');
        $this->addSql('ALTER TABLE grade_student DROP FOREIGN KEY FK_4D6E3DD1CB944F1A');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE grade_student');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE subject');
    }
}
