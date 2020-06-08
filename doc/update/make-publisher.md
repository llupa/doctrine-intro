Publisher
---------

Below you will find a full output of our `make:entity` command run and the options we are choosing.

```
 bin/console make:entity

 Class name of the entity to create or update (e.g. DeliciousJellybean):
 > Publisher

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > address

 Field type (enter ? to see all types) [string]:
 > OneToOne

 What class should this entity be related to?:
 > Address

 Is the Publisher.address property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to Address so that you can access/update Publisher objects from it - e.g. $address->getPublisher()? (yes/no) [no]:
 > no

 updated: src/Entity/Publisher.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 

 Success! 
```

Return to [main page](../../README.md).
