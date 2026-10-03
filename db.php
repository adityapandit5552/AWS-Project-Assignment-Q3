```php
<?php

$host = "database-1.c1gs0qq2yipw.ap-south-1.rds.amazonaws.com";
$dbname = "studentdb";
$username = "admin";
$password = "YOUR-RDS-PASSWORD";
$port = 3306;

$conn = new mysqli(
    $host,
    $username,
    $password,
    $dbname,
    $port
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>
```
