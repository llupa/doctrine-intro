PriceHistory
============

```
 bin/console make:entity

 Class name of the entity to create or update (e.g. AgreeablePizza):
 > PriceHistory

 created: src/Entity/PriceHistory.php
 created: src/Repository/PriceHistoryRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > setOn

 Field type (enter ? to see all types) [string]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 > no   

 updated: src/Entity/PriceHistory.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > value

 Field type (enter ? to see all types) [string]:
 > decimal

 Precision (total number of digits stored: 100.00 would be 5) [10]:
 > 5

 Scale (number of decimals to store: 100.00 would be 2) [0]:
 > 2

 Can this field be null in the database (nullable) (yes/no) [no]:
 > no

 updated: src/Entity/PriceHistory.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > bookIdentifier

 Field type (enter ? to see all types) [string]:
 > integer

 Can this field be null in the database (nullable) (yes/no) [no]:
 > no

 updated: src/Entity/PriceHistory.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 
 
 Success! 
```

Return to [main page](../../README.md).
