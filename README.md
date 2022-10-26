
## CRUD for developers


## Installation
1. clone from my repository; 
2. Configure config.php 
If you leave config.php empty, the program will force you to create a new database. If you fill the config.php with the following information, the program will be able to prepare crud for your database

```bash
  <?php 
   $baza = mysqli_connect("localhost", "root", "password", "your_db");
   $tables =$baza->query( "SHOW TABLES IN your_db");
   $db="your_db";
```
3. Configure configtable.php
 If you have included your own database in config.php, you must include any existing table names in configtable.php.
```bash
  <?php 
   $tablename = "your_table_name";
``` 