<?php
$title = "MYTOTOOL";
$lang = "fr";
$name = 'Valentin';

$servername = 'localhost';
$username = 'root';
$password = '';
$database   = 'mytotool';
$charset = 'utf8';

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$conn = new PDO($dsn, $username, $password);

$sql = "SELECT todo.task, todo.checked FROM todo JOIN users ON users.id = todo.user_id WHERE users.user LIKE :name ORDER BY todo.id ASC";

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
        <h1 class="heading-1">MYTOTOOL</h1>
        <p class="currentuser texting-2"><?= $name ?></p><i class="fas fa-user iconuser-1"></i>
    </header>

    <main>
        <div class="welcome">
            <h2 class="heading-2">Bienvenue sur votre Mytotool personnelle</h2>
        </div>



        <section class="todos">
            <?php foreach ($todos as $key => $todo) { ?>
                <div class="todo">
                    <input type="checkbox" <?= $todo["checked"] ? "checked" : "" ?> class="todo_check">
                    <p class="todo_text texting-1"><?= $todo["task"] ?></p>
                    <i class="fas fa-times todo_delete"></i>
                </div>
            <?php } ?>
        </section>

        <div class="addtask">
            <input class="addtask_input" type="text" placeholder="Nouvelle tâche">
            <button class="addtask_btn texting-2" type="submit">Ajouter</button>
        </div>
    </main>

    <footer>
        <p></p>
    </footer>
</body>

</html>