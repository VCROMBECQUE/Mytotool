<?php 
$input = json_decode(file_get_contents('php://input'), true);
$servername = 'localhost';
$username = 'root';
$password = '';
$database  = 'mytotool';
$charset = 'utf8';

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$conn = new PDO($dsn, $username, $password);

$conn->beginTransaction();

$sql = "UPDATE todo SET todo.checked = !todo.checked WHERE todo.id = '$input'";
$query = $conn->prepare($sql);

if($query->execute()){
    $conn->commit();
}
else{
    $conn->rollBack();
}
?>