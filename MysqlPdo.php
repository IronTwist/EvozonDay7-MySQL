<?php

$user = 'Razvansql';
$pass = 'admin';

$pdo = new PDO('mysql:host=127.0.0.1;dbname=classicmodels', $user, $pass);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


echo "\n1.Alexei: ".PHP_EOL;
//2 -> Select all distinct eployee names that work at London office,
//and show me their names prefixed with Londono. The result column name should ne called employees

try {
    $sql = 'SELECT DISTINCT concat(\'London: \',firstName) AS \'Employees\' 
            FROM employees 
            INNER JOIN offices 
            WHERE city=\'London\'';

    echo '| Employees |' . PHP_EOL;

    foreach ($pdo->query($sql) as $row) {
        print $row['Employees'] . PHP_EOL;
    }
}catch (Exception $e){
    echo 'Looks like you have an error, better check it: '. $e->getMessage();
}


echo "\n2.Michael: ".PHP_EOL;
//7 -> Show top 5 employees by sales
try {
    $sql = 'SELECT lastName, firstName, amount 
            FROM employees 
            INNER JOIN customers 
            INNER JOIN payments 
            ORDER BY amount DESC limit 5';

    echo 'lastName | firstName | amount'.PHP_EOL;

    foreach ($pdo->query($sql) as $row) {
        print $row['lastName'].' '.$row['firstName'].' '.$row['amount'].PHP_EOL;
    }
}catch (Exception $e){
    echo 'Looks like you have an error, better check it: '. $e->getMessage();
}


echo "\n3.Mihai: ".PHP_EOL;
//11 -> Show all customers (firstname, lastname, order number, status, comments)
//where firstname starts with letter T and have some comments

try {
    $sql = 'SELECT contactFirstName, contactLastName, orderNumber, status, comments 
            FROM customers 
            INNER JOIN orders 
            WHERE contactFirstName 
            LIKE \'T%\' 
            AND comments IS NOT NULL';

    echo 'contactFirstName | contactLastName | orderNumber | status | comments'.PHP_EOL;

    foreach ($pdo->query($sql) as $row) {
        print $row['contactFirstName'].' '.
            $row['contactLastName'].' '.
            $row['orderNumber'].' '.
            $row['status'].' '.
            $row['comments'].PHP_EOL;
    }
}catch (Exception $e){
    echo 'Looks like you have an error, better check it: '. $e->getMessage();
}


