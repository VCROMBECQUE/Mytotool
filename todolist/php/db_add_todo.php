<?php
$input = json_decode(file_get_contents('php://input'), true);

$servername = 'localhost';
$username = 'root';
$password = '';
$database  = 'mytotool';
$charset = 'utf8';
$stop = 0;
$db_id_available = 0;

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$conn = new PDO($dsn, $username, $password);
$conn->beginTransaction();
$sql1 = "INSERT INTO `todo` (`id`, `task`, `checked`, `user_id`) VALUES ('";

$sql2 = "SELECT todo.id FROM todo ORDER BY todo.id ASC";

$query2 = $conn->prepare($sql2);
$query2->execute();

$db_ids = $query2->fetchALL(PDO::FETCH_ASSOC);

foreach ($db_ids as $key => $db_id) {
    if ($key+1 != $db_id['id']) {
        $db_id_available = $key+1;
        break;
    }
    $db_id_available = $db_id['id']+1;
}
$sql1 = $sql1 . $db_id_available;

$sql3 = "SELECT users.id FROM users WHERE users.user LIKE :user";

$query3 = $conn->prepare($sql3);
$query3->bindValue(":user", $input['user'], PDO::PARAM_STR);
$query3->execute();

$user_id = $query3->fetch(PDO::FETCH_ASSOC);

$sql1 = $sql1 . "', :tache, '0', :user_id)";

$query1 = $conn->prepare($sql1);
$query1->bindValue(":tache", $input['tache'], PDO::PARAM_STR);
$query1->bindValue(":user_id", $user_id['id'], PDO::PARAM_STR);
if($query1->execute()){
    $conn->commit();
}
else{
    $conn->rollBack();
}

$todo = ["id"=>$db_id_available,"task"=>$input['tache'],"checked"=>""];
header('Content-Type: application/json');
echo json_encode($todo);
?>