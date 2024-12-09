<?php

 require_once './utils/db-name.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./process/process_create.php" method="post">

    <label for="lastname">Nom :</label>
    <input type="text" id="lastname" name="lastname" required placeholder="Entrez votre nom">
    <br><br>

    <label for="firstname">Prénom :</label>
    <input type="text" id="firstname" name="firstname" required placeholder="Entrez votre prénom">
    <br><br>

    <label for="birthdate">Date de naissance :</label>
    <input type="date" id="birthdate" name="birthdate" required>
    <br><br>

    <label for="phone">Téléphone :</label>
    <input type="tel" id="phone" name="phone" required placeholder="Entrez votre numéro">
    <br><br>

    <label for="mail">Email :</label>
    <input type="email" id="mail" name="mail" required placeholder="Entrez votre adresse email">
    <br><br>
 

  <button type="submit" name='valider' >Envoyer</button>

    </form>
</body>
</html>