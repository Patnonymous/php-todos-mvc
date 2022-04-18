<?php
$dataSourceName = 'mysql:host=localhost;dbname=jobsplanner';
$username = 'root';

try {
    $db = new PDO($dataSourceName, $username);
} catch (PDOException $e) {
    $error = "Database Error: ";
    $error .= $e->getMessage();
    include('view/error.php');
    exit();
}
