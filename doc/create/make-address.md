Author
------

Below you will find a full output of our `make:entity` command run, and the options we are choosing.

```
bin/console make:entity

 Class name of the entity to create or update (e.g. GentleElephant):
 > Address

 created: src/Entity/Address.php
 created: src/Repository/AddressRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > street

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Address.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 
 
 Success! 
```

Return to [main page](../../README.md).
