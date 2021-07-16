<?php

$user = 'Razvansql';
$pass = 'admin';

$pdo = new PDO('mysql:host=127.0.0.1;dbname=classicmodels', $user, $pass);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


echo "\n1.Alexei: ".PHP_EOL;
//2 -> Select all distinct eployee names that work at London office,
//and show me their names prefixed with London. The result column name should ne called employees

try {
    $sql = 'SELECT DISTINCT concat(\'London: \',firstName) AS \'Employees\' 
            FROM employees E
            INNER JOIN offices O
            ON E.officeCode = O.officeCode
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
//SELECT sum(P.amount)  FROM customers as C INNER JOIN payments as P ON P.customerNumber = C.customerNumber  INNER JOIN employees as E  ON C.salesRepEmployeeNumber = E.employeeNumber GROUP BY E.employeeNumber LIMIT 5;

try {
    $sql = 'SELECT E.employeeNumber, E.lastName, E.firstName, 
            SUM(P.amount) AS Sales  
            FROM customers as C 
            INNER JOIN payments as P ON P.customerNumber = C.customerNumber  
            INNER JOIN employees as E  ON C.salesRepEmployeeNumber = E.employeeNumber 
            GROUP BY E.employeeNumber 
            ORDER BY Sales DESC LIMIT 5;';

    echo 'lastName | firstName | amount'.PHP_EOL;

    foreach ($pdo->query($sql) as $row) {
        print $row['employeeNumber'].' '.
            $row['lastName'].' '.
            $row['firstName'].' '.
            $row['Sales'].PHP_EOL;
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
            ON customers.customerNumber = orders.customerNumber
            WHERE customers.contactFirstName
            LIKE \'T%\' 
            AND comments IS NOT NULL';

    echo ' firstName | contactLastName | orderNumber | status | comments'.PHP_EOL;

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


