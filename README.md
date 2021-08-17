cruder
======

*Cruder* is Simple libaray to perform all your database functions.
it is very easy as ABC
###### It is still under development and the community is welcome to add their functions

using this library, you can perform certain mysql functions like
- Select
  - Select with limit
  - Select with Offset
  - Select specific columns
- Insert
  - Insert as an array (forget about queries)

*Example of Select*
```php
  use Cruder\Sharp\SharpCrud as Cruder;
  $cruder = Cruder::getInstance('localhost', 'root', '', 'employees');
  $cruder->table('employees');
  $result = $cruder->getAll();
```

*Select specific columns*
```php
  use Cruder\Sharp\SharpCrud as Cruder;
  $cruder = Cruder::getInstance('localhost', 'root', '', 'employees');
  $select = array('emp_no', 'dept_no');
  $cruder->table('employees');
  $cruder->select($select);
 
  $result = $cruder->getAll();
```


*Select with Limit*
```php
  use Cruder\Sharp\SharpCrud as Cruder;
  $cruder = Cruder::getInstance('localhost', 'root', '', 'employees');
  $cruder->table('employees');
  $cruder->limit(50);
  $result = $cruder->getAll();
```

*Select with Limit and offset*
```php
  use Cruder\Sharp\SharpCrud as Cruder;
  $cruder = Cruder::getInstance('localhost', 'root', '', 'employees');
  $cruder->table('employees');
  $cruder->offset(1);
  $cruder->limit(50);
  $result = $cruder->getAll();
```

*Select with WHERE*
```php
  use Cruder\Sharp\SharpCrud as Cruder;
  $cruder = Cruder::getInstance('localhost', 'root', '', 'employees');
  //WHERE has to be an array
  $cruder->table('employees')->where(array('emp_no', '=', 500000));
  $result = $cruder->getAll();
```

*Even the insert is very easy:*

```php
  use Cruder\Sharp\SharpCrud as Cruder;
  $cruder = Cruder::getInstance('localhost', 'root', '', 'employees');
  $cruder->table('employees');
  $insert = array('emp_no' => '500000', 'birth_date' => '1992-01-21', 'first_name'=> "husnain", "last_name" => 'ahmed', 'gender' => 'M', 'hire_date' => '2001-04-02');
  $insert_return = $cruder->insert($insert); // it will return the inserted ID
  
```
