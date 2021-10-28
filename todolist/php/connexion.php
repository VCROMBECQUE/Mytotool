<?php
var_dump($_POST);

include_once "./db.php";

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

