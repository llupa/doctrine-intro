Book
----

Below you will find a full output of our `make:entity` command run and the options we are choosing.

```
 bin/console make:entity

 Class name of the entity to create or update (e.g. GentleChef):
 > Book

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > publisher

 Field type (enter ? to see all types) [string]:
 > ManyToOne

 What class should this entity be related to?:
 > Publisher

 Is the Book.publisher property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to Publisher so that you can access/update Book objects from it - e.g. $publisher->getBooks()? (yes/no) [yes]:
 > no

 updated: src/Entity/Book.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > authors
 
 Field type (enter ? to see all types) [string]:
 > ManyToMany
 
 What class should this entity be related to?:
 > Author
 
 Do you want to add a new property to Author so that you can access/update Book objects from it - e.g. $author->getBooks()? (yes/no) [yes]:
 > yes
 
 A new property will also be added to the Author class so that you can access the related Book objects from it.
 
 New field name inside Author [books]:
 > books
 
 updated: src/Entity/Book.php
 updated: src/Entity/Author.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 
    
 Success!  
```

Return to [main page](../../README.md).
