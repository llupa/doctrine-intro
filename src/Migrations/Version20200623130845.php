<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200623130845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_CBE5A33140C86FCE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, publisher_id, title, price FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publisher_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, price NUMERIC(5, 2) NOT NULL, CONSTRAINT FK_CBE5A33140C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO book (id, publisher_id, title, price) SELECT id, publisher_id, title, price FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A33140C86FCE ON book (publisher_id)');
        $this->addSql('DROP INDEX IDX_9478D345F675F31B');
        $this->addSql('DROP INDEX IDX_9478D34516A2B381');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book_author AS SELECT book_id, author_id FROM book_author');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('CREATE TABLE book_author (book_id INTEGER NOT NULL, author_id INTEGER NOT NULL, PRIMARY KEY(book_id, author_id), CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO book_author (book_id, author_id) SELECT book_id, author_id FROM __temp__book_author');
        $this->addSql('DROP TABLE __temp__book_author');
        $this->addSql('CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)');
        $this->addSql('CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)');
        $this->addSql('DROP INDEX IDX_D4E6F81F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__address AS SELECT id, author_id, street FROM address');
        $this->addSql('DROP TABLE address');
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, street VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_D4E6F81F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO address (id, author_id, street) SELECT id, author_id, street FROM __temp__address');
        $this->addSql('DROP TABLE __temp__address');
        $this->addSql('CREATE INDEX IDX_D4E6F81F675F31B ON address (author_id)');
        $this->addSql('DROP INDEX UNIQ_9CE8D546F5B7AF75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publisher AS SELECT id, address_id, name, datetime("now") as last_update FROM publisher');
        $this->addSql('DROP TABLE publisher');
        $this->addSql('CREATE TABLE publisher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, last_update DATETIME NOT NULL, CONSTRAINT FK_9CE8D546F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO publisher (id, address_id, name, last_update) SELECT id, address_id, name, last_update FROM __temp__publisher');
        $this->addSql('DROP TABLE __temp__publisher');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9CE8D546F5B7AF75 ON publisher (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_D4E6F81F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__address AS SELECT id, author_id, street FROM address');
        $this->addSql('DROP TABLE address');
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, street VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO address (id, author_id, street) SELECT id, author_id, street FROM __temp__address');
        $this->addSql('DROP TABLE __temp__address');
        $this->addSql('CREATE INDEX IDX_D4E6F81F675F31B ON address (author_id)');
        $this->addSql('DROP INDEX IDX_CBE5A33140C86FCE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, publisher_id, title, price FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publisher_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, price NUMERIC(5, 2) NOT NULL)');
        $this->addSql('INSERT INTO book (id, publisher_id, title, price) SELECT id, publisher_id, title, price FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A33140C86FCE ON book (publisher_id)');
        $this->addSql('DROP INDEX IDX_9478D34516A2B381');
        $this->addSql('DROP INDEX IDX_9478D345F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book_author AS SELECT book_id, author_id FROM book_author');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('CREATE TABLE book_author (book_id INTEGER NOT NULL, author_id INTEGER NOT NULL, PRIMARY KEY(book_id, author_id))');
        $this->addSql('INSERT INTO book_author (book_id, author_id) SELECT book_id, author_id FROM __temp__book_author');
        $this->addSql('DROP TABLE __temp__book_author');
        $this->addSql('CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)');
        $this->addSql('CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)');
        $this->addSql('DROP INDEX UNIQ_9CE8D546F5B7AF75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publisher AS SELECT id, address_id, name FROM publisher');
        $this->addSql('DROP TABLE publisher');
        $this->addSql('CREATE TABLE publisher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO publisher (id, address_id, name) SELECT id, address_id, name FROM __temp__publisher');
        $this->addSql('DROP TABLE __temp__publisher');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9CE8D546F5B7AF75 ON publisher (address_id)');
    }
}
