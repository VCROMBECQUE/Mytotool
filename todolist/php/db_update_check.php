<?php 
$input = json_decode(file_get_contents('php://input'), true);
var_dump($input);
$servername = 'localhost';
$username = 'root';
$password = '';
$database  = 'mytotool';
$charset = 'utf8';

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$conn = new PDO($dsn, $username, $password);

$sql = "UPDATE todo SET todo.checked = !todo.checked WHERE todo.id = '$input'";
var_dump($sql);

$query = $conn->prepare($sql);
$query->execute();

?>