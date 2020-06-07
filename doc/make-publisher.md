Publisher
---------

Below you will find a full output of our `make:entity` command run, and the options we are choosing.

```
bin/console make:entity

 Class name of the entity to create or update (e.g. OrangeKangaroo):
 > Publisher

 created: src/Entity/Publisher.php
 created: src/Repository/PublisherRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > name 

 Field type (enter ? to see all types) [string]:
 > ?

 Main types
  * string
  * text
  * boolean
  * integer (or smallint, bigint)
  * float

 Relationships / Associations
  * relation (a wizard 🧙 will help you build the relation)
  * ManyToOne
  * OneToMany
  * ManyToMany
  * OneToOne

 Array/Object Types
  * array (or simple_array)
  * json
  * object
  * binary
  * blob

 Date/Time Types
  * datetime (or datetime_immutable)
  * datetimetz (or datetimetz_immutable)
  * date (or date_immutable)
  * time (or time_immutable)
  * dateinterval

 Other Types
  * decimal
  * guid
  * json_array


 Field type (enter ? to see all types) [string]:
 > string

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > no

 updated: src/Entity/Publisher.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 
           
 Success!
```

Return to [main page](../README.md).
