<?php
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:host=localhost;dbname=AlkDB';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
    echo 'erfolg!';


} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}



?>
