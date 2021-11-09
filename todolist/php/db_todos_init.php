<?php
$input = json_decode(file_get_contents('php://input'), true);

include_once "./config_db.php";

$conn->beginTransaction();

$sql = "SELECT todo.id, todo.task, todo.checked FROM todo JOIN users ON users.id = todo.user_id WHERE users.user LIKE :name ORDER BY todo.id ASC";

$query = $conn->prepare($sql);
$query->bindValue(":name", $input, PDO::PARAM_STR);

if($query->execute()){
    $conn->commit();
}
else{
    $conn->rollBack();
}

$todos = $query->fetchALL(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($todos);
?>