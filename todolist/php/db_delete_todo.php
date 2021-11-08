<?php 
$input = json_decode(file_get_contents('php://input'), true);

include_once "./config_db.php";

$conn->beginTransaction();

$sql = "DELETE FROM todo WHERE todo.id = $input";

$query = $conn->prepare($sql);

if($query->execute()){
    $conn->commit();
}
else{
    $conn->rollBack();
}
?>