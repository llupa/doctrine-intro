Publisher
---------

```
bin/console app:find:publisher --id=1                     

Finding Publisher ...
=====================

 ---- ---------------------- --------- --------------------------- 
  ID   Name                   Street    Last update                
 ---- ---------------------- --------- --------------------------- 
  1    Penguin Random House   Chicago   2020-06-23T13:17:58+00:00  
 ---- ---------------------- --------- --------------------------- 
```

```
bin/console app:find:publisher --name="Harper Collins"

Finding Publisher ...
=====================

 ---- ---------------- --------- --------------------------- 
  ID   Name             Street    Last update                
 ---- ---------------- --------- --------------------------- 
  3    Harper Collins   Bagdhad   2020-06-23T13:17:58+00:00  
 ---- ---------------- --------- --------------------------- 
```

```
bin/console app:find:publisher

Finding Publisher ...
=====================

 ---- ---------------------- --------- --------------------------- 
  ID   Name                   Street    Last update                
 ---- ---------------------- --------- --------------------------- 
  1    Penguin Random House   Chicago   2020-06-23T13:17:58+00:00  
  2    Macmillan Publishers   Tokyo     2020-06-23T13:37:03+00:00  
  3    Harper Collins         Bagdhad   2020-06-23T13:17:58+00:00  
 ---- ---------------------- --------- ---------------------------
```

Return to [main page](../../../README.md).
