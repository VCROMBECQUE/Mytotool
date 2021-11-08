<?php
$title = "MYTOTOOL";
$lang = "fr";
$name = 'Valentin';

include_once "../php/config_db.php";

$sql = "SELECT todo.id, todo.task, todo.checked FROM todo JOIN users ON users.id = todo.user_id WHERE users.user LIKE :name ORDER BY todo.id ASC";

$query = $conn->prepare($sql);
$query->bindValue(":name", $name, PDO::PARAM_STR);
$query->execute();


$todos = $query->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang=<?= $lang ?>>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="../dist/css/main.min.css">
    <title><?= $title . " de " . $name ?> </title>
</head>

<body>

    <header>
        <h1><a class="heading-1" href="./index.html">MYTOTOOL</a></h1>
        <p class="currentuser"><a class="texting-2" href="./connexion.html" id="user"><?= $name ?></a></p><a href="./connexion.html"><i class="fas fa-user iconuser-1"></i></a>
    </header>

    <main>
        <div class="welcome">
            <h2 class="heading-2">Bienvenue sur votre Mytotool personnelle</h2>
        </div>

        <section id="todos" class="todos scroller">
            <?php foreach ($todos as $todo) { ?>
                <div class="todo" id=<?= "todo_" . $todo["id"] ?>>
                    <input type="checkbox" <?= $todo["checked"] ? "checked" : "" ?> class="todo_check" id=<?= "check_todo_" . $todo["id"] ?> onclick="update_check()">
                    <p class="todo_text texting-1"><?= $todo["task"] ?></p>
                    <div class="todo_options">
                        <i class="fas fa-times todo_options_delete" id=<?= "delete_todo_" . $todo["id"] ?> onclick="delete_todo()"></i>
                        <i class="fas fa-edit todo_options_update" id=<?= "update_todo_" . $todo["id"] ?> onclick="update_todo()"></i>
                    </div>

                </div>
            <?php } ?>
        </section>

        <div class="addtask">
            <input class="addtask_input" type="text" placeholder="Nouvelle tâche" id="tache">
            <button class="addtask_btn texting-2" type="button" id="add_new_todo" onclick="add_todo()">Ajouter</button>
        </div>
    </main>

    <script src="../js/mytotool.js"></script>
</body>

</html>