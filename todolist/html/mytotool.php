<?php
$name = 'Valentin';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="../dist/css/main.min.css">
    <title><?= "MYTOTOOL de " . $name ?> </title>
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
        </section>

        <div class="addtask">
            <input class="addtask_input" type="text" placeholder="Nouvelle tâche" id="tache">
            <button class="addtask_btn texting-2" type="button" id="add_new_todo" onclick="add_todo()"><i class="fas fa-angle-right "></i></button>
        </div>
    </main>

    <script src="../js/mytotool.js"></script>
</body>

</html>