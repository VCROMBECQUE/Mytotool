<?php 
$input = json_decode(file_get_contents('php://input'), true);
$servername = 'localhost';
$username = 'root';
$password = '';
$database  = 'mytotool';
$charset = 'utf8';

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$conn = new PDO($dsn, $username, $password);

$sql = "DELETE FROM todo WHERE todo.id = $input";

$query = $conn->prepare($sql);
$query->execute();
?>