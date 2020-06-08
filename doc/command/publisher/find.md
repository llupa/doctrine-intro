Publisher
---------

```
bin/console app:find:publisher --id=1                     

Finding Publisher ...
=====================

 ---- ---------------------- --------- 
  ID   Name                   Street   
 ---- ---------------------- --------- 
  1    Penguin Random House   Chicago  
 ---- ---------------------- --------- 
```

```
bin/console app:find:publisher --name="Harper Collins"

Finding Publisher ...
=====================

 ---- ---------------- --------- 
  ID   Name             Street   
 ---- ---------------- --------- 
  3    Harper Collins   Bagdhad  
 ---- ---------------- --------- 
```

```
bin/console app:find:publisher

Finding Publisher ...
=====================

 ---- ---------------------- --------- 
  ID   Name                   Street   
 ---- ---------------------- --------- 
  1    Penguin Random House   Chicago  
  2    Hachette Livre         Tokyo    
  3    Harper Collins         Bagdhad  
 ---- ---------------------- --------- 
```

Return to [main page](../../../README.md).
