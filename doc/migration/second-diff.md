```                                                             
                    Application Migrations                    
                                                              

WARNING! You are about to execute a database migration that could result in schema changes and data loss. Are you sure you wish to continue? (y/n)y
Migrating up to 20200623114440 from 0

  ++ migrating 20200623101156

     -> CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price NUMERIC(5, 2) NOT NULL)
     -> CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, street VARCHAR(255) NOT NULL)
     -> CREATE TABLE publisher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)
     -> CREATE TABLE author (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL)

  ++ migrated (took 45.4ms, used 12M memory)

  ++ migrating 20200623114440

     -> CREATE TABLE book_author (book_id INTEGER NOT NULL, author_id INTEGER NOT NULL, PRIMARY KEY(book_id, author_id))
     -> CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)
     -> CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)
     -> CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, price FROM book
     -> DROP TABLE book
     -> CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publisher_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, price NUMERIC(5, 2) NOT NULL, CONSTRAINT FK_CBE5A33140C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
     -> INSERT INTO book (id, title, price) SELECT id, title, price FROM __temp__book
     -> DROP TABLE __temp__book
     -> CREATE INDEX IDX_CBE5A33140C86FCE ON book (publisher_id)
     -> CREATE TEMPORARY TABLE __temp__address AS SELECT id, street FROM address
     -> DROP TABLE address
     -> CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, street VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_D4E6F81F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
     -> INSERT INTO address (id, street) SELECT id, street FROM __temp__address
     -> DROP TABLE __temp__address
     -> CREATE INDEX IDX_D4E6F81F675F31B ON address (author_id)
     -> CREATE TEMPORARY TABLE __temp__publisher AS SELECT id, name FROM publisher
     -> DROP TABLE publisher
     -> CREATE TABLE publisher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_9CE8D546F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
     -> INSERT INTO publisher (id, name) SELECT id, name FROM __temp__publisher
     -> DROP TABLE __temp__publisher
     -> CREATE UNIQUE INDEX UNIQ_9CE8D546F5B7AF75 ON publisher (address_id)

  ++ migrated (took 48.1ms, used 12M memory)

  ------------------------

  ++ finished in 54.1ms
  ++ used 12M memory
  ++ 2 migrations executed
  ++ 25 sql queries
```

Return to [main page](../../README.md).
