Author
------

Below you will find a full output of our `make:entity` command run and the options we are choosing.

```
 bin/console make:entity

 Class name of the entity to create or update (e.g. TinyElephant):
 > Author

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > addresses

 Field type (enter ? to see all types) [string]:
 > OneToMany

 What class should this entity be related to?:
 > Address

 A new property will also be added to the Address class so that you can access and set the related Author object from it.

 New field name inside Address [author]:
 > author

 Is the Address.author property allowed to be null (nullable)? (yes/no) [yes]:
 > yes

 updated: src/Entity/Author.php
 updated: src/Entity/Address.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 
 
 Success!
``` 

Return to [main page](../../README.md).
