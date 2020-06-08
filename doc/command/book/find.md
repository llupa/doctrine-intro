Book
----

```
bin/console app:find:book --id=1

Finding Book ...
================

 ---- ---------------- ------- ---------------------- -------------- 
  ID   Title            Price   Publisher              Author count  
 ---- ---------------- ------- ---------------------- -------------- 
  1    The Testaments   10,99   Penguin Random House   1             
 ---- ---------------- ------- ---------------------- -------------- 

 Do you want to show Authors for a Book listed above? [yes]:
 > yes

 Type in the Book id:
 > 1

 ---------------- ------------------ 
  Book title       Author            
 ---------------- ------------------ 
  The Testaments   Margaret  Atwood  
 ---------------- ------------------ 
```

```
bin/console app:find:book --title="The Testaments"

Finding Book ...
================

 ---- ---------------- ------- ---------------------- -------------- 
  ID   Title            Price   Publisher              Author count  
 ---- ---------------- ------- ---------------------- -------------- 
  1    The Testaments   10,99   Penguin Random House   1             
 ---- ---------------- ------- ---------------------- -------------- 

 Do you want to show Authors for a Book listed above? [yes]:
 > no
```

```
bin/console app:find:book

Finding Book ...
================

 ---- ------------------------- ------- ---------------------- -------------- 
  ID   Title                     Price   Publisher              Author count  
 ---- ------------------------- ------- ---------------------- -------------- 
  1    The Testaments            10,99   Penguin Random House   1             
  2    Where the Crawdads Sing   13,99   Hachette Livre         1             
  3    The Guardians             5,99    Harper Collins         1             
 ---- ------------------------- ------- ---------------------- -------------- 

 Do you want to show Authors for a Book listed above? [yes]:
 > no
```

Return to [main page](../../../README.md).
