```
bin/console doctrine:migration:status

 == Configuration

    >> Name:                                               Application Migrations
    >> Database Driver:                                    pdo_sqlite
    >> Database Host:                                      localhost
    >> Database Name:                                      /Users/stiven.llupa/PhpstormProjects/doctrine-intro/var/data.db
    >> Configuration Source:                               manually configured
    >> Version Table Name:                                 migration_versions
    >> Version Column Name:                                version
    >> Migrations Namespace:                               DoctrineMigrations
    >> Migrations Directory:                               /Users/stiven.llupa/PhpstormProjects/doctrine-intro/src/Migrations
    >> Previous Version:                                   2020-06-23 10:11:56 (20200623101156)
    >> Current Version:                                    2020-06-23 11:44:40 (20200623114440)
    >> Next Version:                                       2020-06-23 13:08:45 (20200623130845)
    >> Latest Version:                                     2020-06-23 13:08:45 (20200623130845)
    >> Executed Migrations:                                2
    >> Executed Unavailable Migrations:                    0
    >> Available Migrations:                               3
    >> New Migrations:                                     1
```
---
```
                    Application Migrations                    
                                                              

WARNING! You are about to execute a database migration that could result in schema changes and data loss. Are you sure you wish to continue? (y/n)y
Migrating up to 20200623130845 from 20200623114440

  ++ migrating 20200623130845

     -> DROP INDEX IDX_CBE5A33140C86FCE
     -> CREATE TEMPORARY TABLE __temp__book AS SELECT id, publisher_id, title, price FROM book
     -> DROP TABLE book
     -> CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publisher_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, price NUMERIC(5, 2) NOT NULL, CONSTRAINT FK_CBE5A33140C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
     -> INSERT INTO book (id, publisher_id, title, price) SELECT id, publisher_id, title, price FROM __temp__book
     -> DROP TABLE __temp__book
     -> CREATE INDEX IDX_CBE5A33140C86FCE ON book (publisher_id)
     -> DROP INDEX IDX_9478D345F675F31B
     -> DROP INDEX IDX_9478D34516A2B381
     -> CREATE TEMPORARY TABLE __temp__book_author AS SELECT book_id, author_id FROM book_author
     -> DROP TABLE book_author
     -> CREATE TABLE book_author (book_id INTEGER NOT NULL, author_id INTEGER NOT NULL, PRIMARY KEY(book_id, author_id), CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)
     -> INSERT INTO book_author (book_id, author_id) SELECT book_id, author_id FROM __temp__book_author
     -> DROP TABLE __temp__book_author
     -> CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)
     -> CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)
     -> DROP INDEX IDX_D4E6F81F675F31B
     -> CREATE TEMPORARY TABLE __temp__address AS SELECT id, author_id, street FROM address
     -> DROP TABLE address
     -> CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, street VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_D4E6F81F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
     -> INSERT INTO address (id, author_id, street) SELECT id, author_id, street FROM __temp__address
     -> DROP TABLE __temp__address
     -> CREATE INDEX IDX_D4E6F81F675F31B ON address (author_id)
     -> DROP INDEX UNIQ_9CE8D546F5B7AF75
     -> CREATE TEMPORARY TABLE __temp__publisher AS SELECT id, address_id, name, datetime("now") as last_update FROM publisher
     -> DROP TABLE publisher
     -> CREATE TABLE publisher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, last_update DATETIME NOT NULL, CONSTRAINT FK_9CE8D546F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
     -> INSERT INTO publisher (id, address_id, name, last_update) SELECT id, address_id, name, last_update FROM __temp__publisher
     -> DROP TABLE __temp__publisher
     -> CREATE UNIQUE INDEX UNIQ_9CE8D546F5B7AF75 ON publisher (address_id)

  ++ migrated (took 43.9ms, used 12M memory)

  ------------------------

  ++ finished in 47.6ms
  ++ used 12M memory
  ++ 1 migrations executed
  ++ 30 sql queries
```

Return to [main page](../../README.md).
