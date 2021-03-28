

# MySQL.lib [DEPRECATED! USE [THIS](https://github.com/TobiHatti/WrapSQL/tree/master/PHP) LIBRARY INSTEAD!]

A simple but widely useable MySQL library with all necessary methods for use in web-development. This class supports parameterised SQL-statements

## Method-Summary

**_General:_**<br />
**ParamTypes**<br />
For `$paramTypes`, the following rules apply for all methods which use this parameter:
- `'s'`- Defines that the first parameters datatype is string
- `'i'` - Defines that the first parameters datatype is integer
- `'d'` - Defines that the first parameters datatype is double
- `'b'` - Defines that the first parameters datatype is BLOB
- `'@s','@i','@d','@b'` - Sets the datatype of all parameters to string/int/...
- `'siis'` - Defines that the 1st and 4th parameter have the datatype `string`, and the 2nd and 3rd have the datatype `int`

**Parameters**<br />
All parameters must be passed by reference, meaning it is only possible to<br />
pass a variable, but not a string or an integer etc. directly!
e.g.:
```php
// NOT ALLOWED
$userArray = MySQL::Cluster("SELECT * FROM users WHERE age = ?",'i',14);

// ALLOWED
$age = 14;
$userArray = MySQL::Cluster("SELECT * FROM users WHERE age = ?",'i',$age);
```

### NonQuery
Execute a SQL-Operation like INSERT, UPDATE, ALTER, ....<br />
```php
// Decalaration
void MySQL::NonQuery(string $sqlStatement [, string $paramTypes, mixed &$parameters...])
```
*Example:*
```php
// PHP Example
MySQL::NonQuery("INSERT INTO users (username,age) VALUES (?,?)",'si',$username,$age);
```


### Scalar
Get 1 value using a SELECT statement<br />
```php
// Declaration
string MySQL::Scalar(string $sqlStatement [, string $paramTypes, mixed &$parameters...])
```
*Example:*
```php
// PHP Example
$userID = 15;
$username = MySQL::Scalar("SELECT username FROM users WHERE id = ?",'i',$userID);
```

### Count
Count rows of a table using a SELECT statement<br />

```php
// Declaration
int MySQL::Count(string $sqlStatement [, string $paramTypes, mixed &$parameters...])
```
*Example:*
```php
// PHP Example
$userAge = 18;
$userCount = MySQL::Count("SELECT * FROM users WHERE age = ?",'i',$userAge);
```

### Exists
Checks if a SQL-entry exists using a SELECT statement<br />

```php
// Declaration
bool MySQL::Exist(string $sqlStatement [, string $paramTypes, mixed &$parameters...])
```
*Example:*
```php
// PHP Example
$username = "TomRowden1978";

if(MySQL::Exist("SELECT * FROM users WHERE username = ?",'s',$username))
{
	throw new Exception("Username already exists!");
}
```
### Row
Get a single row of the table using a SELECT statement<br />
```php
// Declaration
string[] MySQL::Row(string $sqlStatement [, string $paramTypes, mixed &$parameters...])
```
*Example:*
```php
// PHP Example
$userID = 342;
$userData = MySQL::Row("SELECT * FROM users WHERE id = ?",'i',$userID);

// Array-Keywords are the same as the database column
$firstName = $userData["firstName"];
$lastName = $userData["lastName"];
$userAge = $userData["age"];
// ...
```
### Cluster
Get multiple rows of the table using a SELECT statement<br />
```php
// Declaration
string[][] MySQL::Cluster(string $sqlStatement [, string $paramTypes, mixed &$parameters...])
```
*Example:*
```php
$age = 18;

$userDataArray = MySQL::Cluster("SELECT * FROM users WHERE age = ?",'i',$age);

// Run through each table-row
foreach($userDataArray as $userData)
{
	$firstName = $userData["firstName"];
	$lastName = $userData["lastName"];
	$userAge = $userData["age"];
	// ...
}

// OR: access cell directly
$firstName = $userData[0]["firstName"];
// ...
```

### Save
Saves the database to a `.sql` file<br />
```php
// Declaration
void MySQL::Save(string $backupName)
```
*Example:*
```php
MySQL::Save("BackUp-02-2018");
// Creates SQL-File called "Backup-02-2018"
// The directory to save the backups can be set in
// mysql.lib.config.php
```

### PeriodicSave
Regularly saves the database in a specified period<br />
```php
// Declaration
void MySQL::PeriodicSave([string $backupPeriod = "d"])
```
*Example:*
```php
// PHP Example
MySQL::PeriodicSave();
// Saves database once a day. Default

MySQL::PeriodicSave('w');
// Saves database once a week.

// The backup-name is auto-generated.
// Filename shows backup-periode and date

// Other time intervals:
// h ... once an hour
// d ... once a day
// w ... once a week
```


