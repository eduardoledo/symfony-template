<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308214807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE security_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE security_group_security_role (security_group_id INT NOT NULL, security_role_id INT NOT NULL, INDEX IDX_42933CA9D3F5E95 (security_group_id), INDEX IDX_42933CABBE829B1 (security_role_id), PRIMARY KEY(security_group_id, security_role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE security_permission (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE security_role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, role VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_security_role (user_id INT NOT NULL, security_role_id INT NOT NULL, INDEX IDX_66F6ABFBA76ED395 (user_id), INDEX IDX_66F6ABFBBBE829B1 (security_role_id), PRIMARY KEY(user_id, security_role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_security_group (user_id INT NOT NULL, security_group_id INT NOT NULL, INDEX IDX_EAF97836A76ED395 (user_id), INDEX IDX_EAF978369D3F5E95 (security_group_id), PRIMARY KEY(user_id, security_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE security_group_security_role ADD CONSTRAINT FK_42933CA9D3F5E95 FOREIGN KEY (security_group_id) REFERENCES security_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE security_group_security_role ADD CONSTRAINT FK_42933CABBE829B1 FOREIGN KEY (security_role_id) REFERENCES security_role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_security_role ADD CONSTRAINT FK_66F6ABFBA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_security_role ADD CONSTRAINT FK_66F6ABFBBBE829B1 FOREIGN KEY (security_role_id) REFERENCES security_role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_security_group ADD CONSTRAINT FK_EAF97836A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_security_group ADD CONSTRAINT FK_EAF978369D3F5E95 FOREIGN KEY (security_group_id) REFERENCES security_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP roles, CHANGE is_verified is_verified TINYINT(1) DEFAULT false NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE security_group_security_role DROP FOREIGN KEY FK_42933CA9D3F5E95');
        $this->addSql('ALTER TABLE user_security_group DROP FOREIGN KEY FK_EAF978369D3F5E95');
        $this->addSql('ALTER TABLE security_group_security_role DROP FOREIGN KEY FK_42933CABBE829B1');
        $this->addSql('ALTER TABLE user_security_role DROP FOREIGN KEY FK_66F6ABFBBBE829B1');
        $this->addSql('DROP TABLE security_group');
        $this->addSql('DROP TABLE security_group_security_role');
        $this->addSql('DROP TABLE security_permission');
        $this->addSql('DROP TABLE security_role');
        $this->addSql('DROP TABLE user_security_role');
        $this->addSql('DROP TABLE user_security_group');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reset_password_request CHANGE selector selector VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hashed_token hashed_token VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `user` ADD roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE is_verified is_verified TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE user_profile CHANGE first_name first_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
