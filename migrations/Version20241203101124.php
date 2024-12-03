<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241203101124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE quiz CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql("INSERT INTO `answer` (`id`, `question_id`, `text`, `correct`, `created_at`, `active`) VALUES
            (1, 9, 'Vrai', 0, '2024-11-07 10:35:25', 1),
            (2, 9, 'Faux', 1, '2024-11-07 10:35:25', 1),
            (3, 10, 'Luc Plamondon', 1, '2024-11-07 10:35:25', 1),
            (4, 10, 'Bernard Cohen', 0, '2024-11-07 10:35:25', 1),
            (5, 11, 'Vrai', 1, '2024-11-12 12:43:14', 1),
            (6, 11, 'Faux', 0, '2024-11-12 12:43:14', 1),
            (7, 13, 'Vrai', 1, '2024-11-12 14:48:53', 1),
            (8, 13, 'Faux', 0, '2024-11-12 14:48:53', 1),
            (9, 14, 'Vrai', 1, '2024-11-19 16:10:52', 1),
            (10, 14, 'Faux', 0, '2024-11-19 16:10:52', 1),
            (11, 15, 'Amogus', 1, '2024-11-19 16:10:52', 1),
            (12, 15, 'Algérienne', 0, '2024-11-19 16:10:52', 1),
            (13, 15, 'La sauce quoi?', 0, '2024-11-19 16:10:52', 0);");
        $this->addSql("INSERT INTO `question` (`id`, `quiz_id`, `type`, `text`, `chrono`, `created_at`, `active`) VALUES
            (1, 1, 1, 'Etes-vous vivant?', 5, '2024-11-07 07:48:00', 1),
            (2, 2, 1, 'Etes-vous vivant?', 5, '2024-11-07 07:49:00', 1),
            (3, 3, 3, 'felzkfn', 10, '2024-11-07 08:18:18', 0),
            (4, 3, 1, 'Vraiment?', 12, '2024-11-07 08:19:09', 1),
            (5, 4, 2, 'Pourquoi pas', 1, '2024-11-07 08:20:12', 0),
            (6, 4, 1, 'La deuxième(bis)', 4, '2024-11-07 08:20:12', 1),
            (7, 5, 1, 'Est-tu un sourcier, Harry?', 5, '2024-11-07 08:28:39', 1),
            (8, 2, 1, 'Testos', 3, '2024-11-07 09:13:25', 1),
            (9, 6, 1, 'Starmania est sorti en 1990', 5, '2024-11-07 10:35:25', 1),
            (10, 6, 2, 'Qui est le compositeur de Starmania?', 10, '2024-11-07 10:35:25', 1),
            (11, 7, 1, 'baerbeqer', 3, '2024-11-12 12:43:14', 1),
            (12, 8, 1, 'gréver', 1, '2024-11-12 12:43:58', 1),
            (13, 9, 1, 'gégé', 5, '2024-11-12 14:48:53', 1),
            (14, 10, 1, 'BBQ', 5, '2024-11-19 16:10:52', 1),
            (15, 10, 2, 'Sauce blanche', 11, '2024-11-19 16:10:52', 1);");
        $this->addSql("INSERT INTO `quiz` (`id`, `user_id`, `state_id`, `title`, `nb_question`, `created_at`) VALUES
            (1, NULL, 2, 'La vie', NULL, '2024-11-07 07:48:00'),
            (2, NULL, 2, 'La vie', NULL, '2024-11-07 07:49:00'),
            (3, NULL, 4, 'Test', NULL, '2024-11-07 08:18:18'),
            (4, NULL, 2, 'C\'est original', NULL, '2024-11-07 08:20:12'),
            (5, NULL, 2, 'C\'est de la magie', NULL, '2024-11-07 08:28:39'),
            (6, NULL, 2, 'Starmania', NULL, '2024-11-07 10:35:25'),
            (7, NULL, 2, 'gaevverg', NULL, '2024-11-12 12:43:14'),
            (8, NULL, 5, 'Actif', NULL, '2024-11-12 12:43:58'),
            (9, NULL, 5, 'Test ordre', NULL, '2024-11-12 14:48:53'),
            (10, NULL, 5, 'Bon', NULL, '2024-11-19 16:10:52');");
        $this->addSql("INSERT INTO `quiz_state` (`id`, `state`) VALUES
            (2, 'Brouillon'),
            (3, 'Inactif'),
            (4, 'Archivé'),
            (5, 'Actif');");
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE question CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}