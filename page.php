<?php

$bdd = new PDO('mysql:host=localhost;dbname=tp_db', 'root', 'root');
if (isset($_POST['valider'])) {
    if (!empty($_POST['pseudo']) and !empty($_POST['message'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $message = $_POST['message'];
        $date = date('d-m-y h:i:s');

        $newmsg = $bdd->prepare('INSERT INTO bts4(pseudo,message,date) VALUES(?,?,?)');
        $newmsg->execute(array($pseudo, $message, $date));
    } else {
        echo "<p class = 'text-danger'>Il manque : </p> ";
        // on va afficher ce quil manque en fonction de ce qui est vide


        // si il manque le pseudo et le message on va afficher pseudo et message


        if (empty($_POST['pseudo'])) {
            echo "<p class = 'text-danger'> pseudo </p> ";
        }
        if (empty($_POST['pseudo']) and empty($_POST['message'])) {
            "<p class = 'text-danger'> et </p> ";
        }
        if (empty($_POST['message'])) {
            echo "<p class = 'text-danger'> message </p> ";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <h1>CHATROOM</h1>
            </div>
        </div>
    </header>

    <main class="">
        <form method="POST" action="">
            pseudo : <input type="text" name="pseudo">
            <br>
            message : <input type="text" name="message" class='msg'>
            <br>
            <input type="submit" name="valider">
        </form>

        

    </main>

    <div class="text-center p3">

        <?php

        $bdd = new PDO('mysql:host=localhost;dbname=tp_db', 'root', 'root');

        $takemsg = $bdd->query('SELECT * FROM bts4 ORDER BY id DESC');
        while ($message = $takemsg->fetch()) {
        ?>
            <div class="bg-body-tertiary border rounded-3">
                <p><?= $message['message']; ?></p>
                <br>
                <p><?= $message['date']; ?></p>
                <h4><?= $message['pseudo']; ?></h4>

            </div>

        <?php
        }
        ?>
    </div>


</body>

</html>