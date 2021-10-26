<?php
var_dump($_POST);

$servername = 'localhost';
$username = 'root';
$password = '';
$database  = 'mytotool';
$charset = 'utf8';

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$conn = new PDO($dsn, $username, $password);
$conn->beginTransaction();

$sql = "SELECT users.* FROM users WHERE users.user LIKE :user OR users.email LIKE :user";
$query = $conn->prepare($sql);
$query->bindValue(":user", $_POST['identifiant'], PDO::PARAM_STR);

if($query->execute()){
    $conn->commit();
}
else{
    $conn->rollBack();
}

$user_info = $query->fetchALL(PDO::FETCH_ASSOC);
var_dump($user_info);

