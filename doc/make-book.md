Book
----

Below you will find a full output of our `make:entity` command run, and the options we are choosing.

```
bin/console make:entity

 Class name of the entity to create or update (e.g. GentleGnome):
 > Book

 created: src/Entity/Book.php
 created: src/Repository/BookRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > title

 Field type (enter ? to see all types) [string]:
 > string

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > no

 updated: src/Entity/Book.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > price

 Field type (enter ? to see all types) [string]:
 > decimal

 Precision (total number of digits stored: 100.00 would be 5) [10]:
 > 5

 Scale (number of decimals to store: 100.00 would be 2) [0]:
 > 2

 Can this field be null in the database (nullable) (yes/no) [no]:
 > no

 updated: src/Entity/Book.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >

 Success! 
```

Return to [main page](../README.md).
