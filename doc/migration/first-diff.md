```                                                              
                    Application Migrations                    
                                                              

WARNING! You are about to execute a database migration that could result in schema changes and data loss. Are you sure you wish to continue? (y/n)y
Migrating up to 20200623101156 from 0

  ++ migrating 20200623101156

     -> CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price NUMERIC(5, 2) NOT NULL)
     -> CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, street VARCHAR(255) NOT NULL)
     -> CREATE TABLE publisher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)
     -> CREATE TABLE author (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL)

  ++ migrated (took 46.5ms, used 12M memory)

  ------------------------

  ++ finished in 51.6ms
  ++ used 12M memory
  ++ 1 migrations executed
  ++ 4 sql queries
```

Return to [main page](../README.md).
