<?php
$input = json_decode(file_get_contents('php://input'), true);

include_once "./config_db.php";

$conn->beginTransaction();
$sql_get_user_id = "SELECT users.id FROM users WHERE users.user LIKE :user";

$query_get_user_id = $conn->prepare($sql_get_user_id);
$query_get_user_id->bindValue(":user", $input['user'], PDO::PARAM_STR);
if ($query_get_user_id->execute()) {
    $user_id = $query_get_user_id->fetch(PDO::FETCH_ASSOC);
    $conn->commit();
} else {
    $conn->rollBack();
    die;
}

$conn->beginTransaction();
$sql_add_todo = "INSERT INTO `todo` (`id`, `task`, `user_id`) VALUES (NULL, :tache, :user_id)";

$query_add_todo = $conn->prepare($sql_add_todo);
$query_add_todo->bindValue(":tache", $input['tache']);
$query_add_todo->bindValue(":user_id", $user_id['id']);
if ($query_add_todo->execute()) {
    $conn->commit();
} else {
    $conn->rollBack();
    die;
}

$conn->beginTransaction();
$sql_get_last_todo_id = "SELECT todo.id FROM todo ORDER BY todo.id DESC LIMIT 1";

$query_get_last_todo_id = $conn->prepare($sql_get_last_todo_id);
if ($query_get_last_todo_id->execute()) {
    $db_todo_id = $query_get_last_todo_id->fetch(PDO::FETCH_ASSOC);
    $conn->commit();
} else {
    $conn->rollBack();
    die;
}

$todo = ["id" => $db_todo_id['id'], "task" => $input['tache'], "checked" => ""];
header('Content-Type: application/json');
echo json_encode($todo);
?>