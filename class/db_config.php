<?php
include_once "DatabaseConnection.php";

$host = 'host';
$dbname = 'dbname';
$user = 'user';
$password = 'password';

$database = new DatabaseConnection($host, $dbname, $user, $password);
$database->connect();

$pdo = $database->getConnection();


