```
                    Application Migrations                    
                                                              

WARNING! You are about to execute a database migration that could result in schema changes and data loss. Are you sure you wish to continue? (y/n)yn
Migrating up to 20200623114440 from 20200623101156

  ++ migrating 20200623114440

     -> CREATE TABLE book_author (book_id INTEGER NOT NULL, author_id INTEGER NOT NULL, PRIMARY KEY(book_id, author_id))
     -> CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)
     -> CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)
     -> CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, price FROM book
     -> DROP TABLE book
     -> CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publisher_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, price NUMERIC(5, 2) NOT NULL, CONSTRAINT FK_CBE5A33140C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
     -> INSERT INTO book (id, title, price) SELECT id, title, price FROM __temp__book
Migration 20200623114440 failed during Execution. Error An exception occurred while executing 'INSERT INTO book (id, title, price) SELECT id, title, price FROM __temp__book':

SQLSTATE[23000]: Integrity constraint violation: 19 NOT NULL constraint failed: book.publisher_id
[error] Error thrown while running command "'doctrine:migration:migrate'". Message: "An exception occurred while executing 'INSERT INTO book (id, title, price) SELECT id, title, price FROM __temp__book':

SQLSTATE[23000]: Integrity constraint violation: 19 NOT NULL constraint failed: book.publisher_id"
```

Return to [main page](../../README.md).
