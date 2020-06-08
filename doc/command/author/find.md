Author
------

```
bin/console app:find:author --id=1  

Finding Author ...
==================

 ---- ------------ ------------- ----------- 
  ID   First name   Middle name   Last name  
 ---- ------------ ------------- ----------- 
  1    Margaret                   Atwood     
 ---- ------------ ------------- -----------  

 Do you want to show addresses for an Author listed above? [yes]: 
 > yes

 Type in the Author id:
 > 1

 ------------------ --------- 
 Author             Address  
 ------------------ --------- 
 Margaret  Atwood   Paris    
 ------------------ ---------
```

```
bin/console app:find:author --firstName="John"

Finding Author ...
==================

 ---- ------------ ------------- ----------- 
  ID   First name   Middle name   Last name  
 ---- ------------ ------------- ----------- 
  3    John                       Grisham    
 ---- ------------ ------------- ----------- 

 Do you want to show addresses for an Author listed above? [yes]:
 > yes

 Type in the Author id:
 > 3

 --------------- ------------- 
  Author          Address      
 --------------- ------------- 
  John  Grisham   Los Angeles  
 --------------- ------------- 
```

```
bin/console app:find:author                   

Finding Author ...
==================

 ---- ------------ ------------- ----------- 
  ID   First name   Middle name   Last name  
 ---- ------------ ------------- ----------- 
  1    Margaret                   Atwood     
  2    Delia                      Owens      
  3    John                       Grisham    
 ---- ------------ ------------- ----------- 

 Do you want to show addresses for an Author listed above? [yes]:
 > no
```

Return to [main page](../../../README.md).
