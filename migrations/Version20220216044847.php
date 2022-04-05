<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216044847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', publie TINYINT(1) DEFAULT NULL, date_publication DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', image_article VARCHAR(255) NOT NULL, INDEX IDX_BFDD316860BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles_categories_articles (articles_id INT NOT NULL, categories_articles_id INT NOT NULL, INDEX IDX_C9B60CE01EBAF6CC (articles_id), INDEX IDX_C9B60CE010C0F0BE (categories_articles_id), PRIMARY KEY(articles_id, categories_articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_articles (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_69239851727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires_articles (id INT AUTO_INCREMENT NOT NULL, articles_id INT DEFAULT NULL, pseudo VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4BEB18611EBAF6CC (articles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mots_cles_articles (id INT AUTO_INCREMENT NOT NULL, mot_cle VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mots_cles_articles_articles (mots_cles_articles_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_6F9E66F6C46A2F4E (mots_cles_articles_id), INDEX IDX_6F9E66F61EBAF6CC (articles_id), PRIMARY KEY(mots_cles_articles_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316860BB6FE6 FOREIGN KEY (auteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE articles_categories_articles ADD CONSTRAINT FK_C9B60CE01EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_categories_articles ADD CONSTRAINT FK_C9B60CE010C0F0BE FOREIGN KEY (categories_articles_id) REFERENCES categories_articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_articles ADD CONSTRAINT FK_69239851727ACA70 FOREIGN KEY (parent_id) REFERENCES categories_articles (id)');
        $this->addSql('ALTER TABLE commentaires_articles ADD CONSTRAINT FK_4BEB18611EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE mots_cles_articles_articles ADD CONSTRAINT FK_6F9E66F6C46A2F4E FOREIGN KEY (mots_cles_articles_id) REFERENCES mots_cles_articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mots_cles_articles_articles ADD CONSTRAINT FK_6F9E66F61EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_categories_articles DROP FOREIGN KEY FK_C9B60CE01EBAF6CC');
        $this->addSql('ALTER TABLE commentaires_articles DROP FOREIGN KEY FK_4BEB18611EBAF6CC');
        $this->addSql('ALTER TABLE mots_cles_articles_articles DROP FOREIGN KEY FK_6F9E66F61EBAF6CC');
        $this->addSql('ALTER TABLE articles_categories_articles DROP FOREIGN KEY FK_C9B60CE010C0F0BE');
        $this->addSql('ALTER TABLE categories_articles DROP FOREIGN KEY FK_69239851727ACA70');
        $this->addSql('ALTER TABLE mots_cles_articles_articles DROP FOREIGN KEY FK_6F9E66F6C46A2F4E');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE articles_categories_articles');
        $this->addSql('DROP TABLE categories_articles');
        $this->addSql('DROP TABLE commentaires_articles');
        $this->addSql('DROP TABLE mots_cles_articles');
        $this->addSql('DROP TABLE mots_cles_articles_articles');
    }
}
