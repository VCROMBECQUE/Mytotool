<?php
$input = json_decode(file_get_contents('php://input'), true);

$servername = 'localhost';
$username = 'root';
$password = '';
$database   = 'mytotool';
$charset = 'utf8';

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$conn = new PDO($dsn, $username, $password);

$sql = "SELECT todo.id, todo.task, todo.checked FROM todo JOIN users ON users.id = todo.user_id WHERE users.user LIKE :name ORDER BY todo.id ASC";

$query = $conn->prepare($sql);
$query->bindValue(":name", $input, PDO::PARAM_STR);
$query->execute();

$todos = $query->fetchALL(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($todos);
?>